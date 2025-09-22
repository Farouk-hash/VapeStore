<?php

namespace App\Livewire\sales;

use App\Models\Bills\BillDetails;
use App\Models\Bills\Bills;
use App\Models\Customer;
use App\Models\Hardware\DeviceInventories;
use App\Models\Vape\LiquidInventory;
use App\Models\Vape\LiquidNicStrength;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class SalesPage extends Component
{
    public $activeTab='summary' , $orderCompleted=false , $createNewCustomer=true , $printReceipt=false;
    public $totalPrice = 0, $discount = 0, $totalPriceAfterDiscount = 0 , $groupTotalPrice = 0 , $totalPriceQuantities = 0;
    public $quantities = [], $summary = [] , $groupQuantitiesArray=[];
    public $customerPhoneNumber, $customerName , $customerSearch  , $customer;

    public function removeItem($itemId , $type = 'single' ){
     
        if ($type == 'groups') {
            unset($this->groupQuantitiesArray[$itemId]);
            $this->groupTotalPrice = collect($this->groupQuantitiesArray)->sum((int)'quantity'*(int)'price');
        } else {
            unset($this->quantities[$itemId]);
            $this->totalPriceQuantities = collect($this->quantities)->sum('total_price_per_item');
        }
        // CHECK IF THIS WAS LAST ITEM @ GROUPS-ARRAY , SINGLE-ITEM-ARRAY ; 
        if(count($this->groupQuantitiesArray)==0 && count($this->quantities)==0){
            $this->dispatch('resetQuantities');
            $this->totalPriceAfterDiscount = 0;
        }

        $this->caclulateTotalPrice();
        $this->buildSummary();
    }
    

    #[On('itemAdded')] // FOR SINGLE-ITEMS [DEVICES , COILS , TANKS , .....];
    public function itemAdded($new_quantities)
    {
        // Update existing items or add new ones (this prevents duplication)
        foreach ($new_quantities as $itemId => $itemData) {
            $this->quantities[$itemId] = $itemData; // This will overwrite existing or add new
        }
        $this->totalPriceQuantities = collect($this->quantities)->sum('total_price_per_item');
        $this->caclulateTotalPrice();
        $this->buildSummary();
    }
    
    #[On('groupAdded')]
    public function groupAdded($groupQuantities , $groupTotalPrice){
        $this->groupQuantitiesArray = $groupQuantities ; 
        $this->groupTotalPrice = $groupTotalPrice ; 
        $this->caclulateTotalPrice();
        $this->buildSummary();

    }

    // Calculate Both Single-Items && Group-Items ; 
    private function caclulateTotalPrice(){
        // dd($this->groupTotalPrice , $this->totalPriceQuantities);
        $this->totalPrice = $this->groupTotalPrice + $this->totalPriceQuantities ; 
    }

    // MODIFIED ;
    #[On('itemRemoved')]
    public function itemRemoved($itemId)
    {
        unset($this->quantities[$itemId]);
        $this->caclulateTotalPrice();
        $this->buildSummary();
    }

    protected function cleanQuantities()
    {
        // Keep only numeric keys (strength IDs) and remove string keys (input names)
        $this->quantities = collect($this->quantities)
            ->filter(function($value, $key) {
                return is_numeric($key) && is_array($value) && isset($value['quantity']) && $value['quantity'] > 0;
            })
            ->toArray();
    }

    protected function buildSummary()
    {
        // Clean quantities before showing
        $this->cleanQuantities();
        
        $summary = [
            'liquids' => [],
            'devices' => [],
            'tanks'   => [],
            'cartridges'=>[],
            'coils'=>[],
            'others' => [],
        ];

        // SINGLE-ITEMS ; 
        $quantities = $this->quantities;
        foreach($quantities as $id => $details) {
            // Skip if quantity is 0 or empty
            if (!isset($details['quantity']) || $details['quantity'] <= 0) {
                continue;
            }
            try{
                switch($details['source']) {
                case 'liquids':
                    // Add null check and proper error handling
                    $liquidNic = LiquidNicStrength::with(['liquid.flavour.brand'])
                        ->where('id', $id)
                        ->first(['strength', 'liquid_id']);
                    
                    // if ($liquidNic && $liquidNic->liquid && $liquidNic->liquid->flavour && $liquidNic->liquid->flavour->brand) {
                        $liquid = $liquidNic->liquid;
                        $flavor = $liquidNic->liquid->flavour;
                        $summary['liquids'][] = [
                            'id' => $id,
                            'flavor' => ['name' => $flavor->name . '  --- ' . $flavor->brand->name],
                            'liquid' => [
                                'type' => $liquid->nicotine_type, 
                                'stype' => $liquid->vape_style, 
                                'bottle_size_ml' => $liquid->bottle_size_ml
                            ],
                            'strength' => $liquidNic->strength,
                            'details' => $details,
                        ];
              
                    break;
                
                case 'devices':
                    $deviceInventoryDetails = DeviceInventories::where('id', $id)->first();
                    $summary['devices'][] = [
                        'id' => $id,
                        'name' => $deviceInventoryDetails->deviceDetails()['name'],
                        'details' => $details,
                    ];
                    break;
                case 'tanks':
                    $tankInventoryDetails = DeviceInventories::where('id' , $id)->first();
                    // dd($tankInventoryDetails->tankDetails()['name']);
                    if($tankInventoryDetails){
                        $summary['tanks'][] = [
                            'id' => $id,
                            'name' => $tankInventoryDetails->tankDetails()['name'],
                            'details' => $details,
                        ];
                    }
                    break;
                case 'cartridges':
                    $cartridgeInventoryDetails = DeviceInventories::where('id' , $id)->first();
                    // dd($tankInventoryDetails->tankDetails()['name']);
                    if($cartridgeInventoryDetails){
                        $summary['cartridges'][] = [
                            'id' => $id,
                            'name' => $cartridgeInventoryDetails->cartridgeDetails()['name'],
                            'details' => $details,
                        ];
                    }
                    break;
                case 'coils':
                    $coilInventoryDetails = DeviceInventories::where('id' , $id)->first();
                    // dd($tankInventoryDetails->tankDetails()['name']);
                    if($coilInventoryDetails){
                        $summary['coils'][] = [
                            'id' => $id,
                            'name' => $coilInventoryDetails->coilSeriesDetails()['name'],
                            'details' => $details,
                        ];
                    }
                    break;
            }
            }catch(Exception $e){
                dd($e->getMessage() , $this->quantities , $id);
            }
            

        }

        $this->totalPriceAfterDiscount = $this->totalPriceAfterDiscount == 0 ? 
        $this->totalPriceQuantities + $this->groupTotalPrice : $this->totalPriceAfterDiscount  ; 
        // dd($this->totalPriceAfterDiscount);
        $summary['payment_details'] = [
            'totalPrice' => $this->totalPriceQuantities + $this->groupTotalPrice,
            'discount' => $this->discount,
            'totalPriceAfterDiscount' =>  $this->totalPriceAfterDiscount ,
        ];
        $summary['groupInventories'] = $this->groupQuantitiesArray;
        $this->summary = $summary;
        $this->orderCompleted=false ; 
    }


    // MODIFIED TO MATCH GROUP ; 
    public function onDiscountApplied()
    {
        // dd($this->discount,$this->totalPriceQuantities , $this->groupTotalPrice);
        if($this->discount && $this->discount < ($this->totalPriceQuantities + $this->groupTotalPrice)) {
            $this->totalPriceAfterDiscount = ($this->totalPriceQuantities +$this->groupTotalPrice) - $this->discount;
            $this->buildSummary();
        } else {
            $this->totalPriceAfterDiscount = $this->totalPriceQuantities +$this->groupTotalPrice;
        }
    }

    public function show(){
        dd($this->quantities , $this->summary);
    }


    public function clearAll()
    {
        if($this->summary){
            if(count($this->summary['liquids']) === 0 || count($this->summary['devices']) === 0 ||
            count($this->summary['cartridges']) === 0 || count($this->summary['tanks']) === 0
            || count($this->summary['groupInventories']) === 0){
                $this->reset(
                [
                'quantities',
                'groupQuantitiesArray','totalPriceQuantities','groupTotalPrice',
                'totalPrice','discount','totalPriceAfterDiscount','customerName','customerPhoneNumber','customerSearch','customer']);
                $this->dispatch('resetQuantities');
                $this->buildSummary();
            }
        }
    }
   

    public function completeOrder(){
        DB::beginTransaction();
        try{
            $has_discount = $this->discount == 0 ? false : true ;

            if($this->totalPrice > 0 && ($this->totalPrice >= $this->totalPriceAfterDiscount)){
                $customerID = $this->customer ? $this->customer->id : null  ;
                $bill = Bills::create(['total_price'=>$this->totalPrice ,
                'has_discount'=> $has_discount , 
                'discount_value'=>$this->discount , 'total_after_discount'=>$this->totalPriceAfterDiscount , 
                'customer_id'=>$customerID]);
                
                $bill->created_by()->associate(Auth::guard($this->getGuard())->user());

                $bill->save();
                
                // SINGLE-ITEMS ; 
                foreach($this->quantities as $itemId => $details){
                    
                    BillDetails::create([
                    'bill_id'=>$bill->id , 

                    'device_inventory_id'=>$details['source']!=='liquids' ? $itemId : null, 
                    'liquid_inventory_id'=>$details['source']=='liquids' ? $details['id'] : null, 

                    'quantity'=> $details['quantity'], 
                    'unit_price'=>$details['base_price'], 'line_total'=>$details['total_price_per_item'] , 
                    'inventory_source'=>$details['source']]);
                    
                    if($details['source']!=='liquids'){
                        $deviceInventory = DeviceInventories::where('id',$itemId)->first();
                        $deviceInventory->decrement('stock_quantity',$details['quantity']);
                    }
                    else{
                        $liquidInventory = LiquidInventory::where('id',$details['id'])->first();
                        $liquidInventory->decrement('stock_received',$details['quantity']);
                    }
                }

                // GROUP INVENTORIES ; 
                foreach($this->summary['groupInventories'] as $id => $details){
                    $line_total = $details['quantity'] * $details['price'];

                    BillDetails::create([
                        'bill_id'=>$bill->id , 'inventory_source'=>'groups' , 
                        'group_inventory_id'=>$id , 
                        'quantity'=>$details['quantity'] , 
                        'unit_price'=> $details['price'], 
                        'line_total'=> $line_total
                    ]);
                    // dd($id);
                    foreach($details['details'] as $index => $detail){
                        if($detail['source']!=='liquids'){
                        $deviceInventory = DeviceInventories::where('id',$detail['devices_id'])->first();
                        $deviceInventory->decrement('stock_quantity',$detail['quantity']* $details['quantity']);
                        }
                        else{
                            $liquidInventory = LiquidInventory::where('id',$detail['liquid_id'])->first();
                            $liquidInventory->decrement('stock_received',$detail['quantity']* $details['quantity']);
                        }
                    }
                }
    
                DB::commit();
                $this->clearAll();
                $this->orderCompleted = true ; 
                $this->dispatch('resetQuantities');
                $this->printReceipt=true; 
            }
        }
        catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    public function toggleCreateCustomer(){
        $this->createNewCustomer = !$this->createNewCustomer;
        $this->reset('customerName','customerPhoneNumber','customerSearch','customer');
    }
    public function onCreateCustomer(){
        if($this->createNewCustomer){
            //CREATE NEW CUSTOMER ; 
            $customer = Customer::firstOrCreate(
                [
                    'phone' => $this->customerPhoneNumber, // lookup key
                ],
                [
                    'name' => $this->customerName,
                    'phone' => $this->customerPhoneNumber,
                ]
            );
            $customer->created_by()->associate(Auth::guard($this->getGuard())->user());
            $customer->save();
        }
        else{
            //LOOK UP Customer ;
            $customer = Customer::where('name',$this->customerSearch)
            ->orWhere('phone',$this->customerSearch)
            ->first(['id','name']);
        }
     
        $this->customer = $customer ?: null ; 
    }

    protected function getGuard(){
        if (Auth::guard('admin')->check()) {
            return 'admin';
        } elseif(Auth::guard('sales')->check()) {
            return 'sales';
        }else{
            throw new Exception('Invalid Process');
        }
    }
    public function render()
    {
        return view('livewire.sales.sales-page');
    }
}