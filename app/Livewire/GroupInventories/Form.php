<?php

namespace App\Livewire\GroupInventories;

use App\Models\GroupInventories\GroupInventory;
use App\Models\GroupInventories\GroupInventoryDetails;
use App\Models\Hardware\DeviceInventories;
use App\Models\Vape\LiquidInventory;
use App\Models\Vape\LiquidNicStrength;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $group_name , $group_price , $selectedItem  , $summary=[] , $quantities=[]; 
    public function submitGroups(){
        DB::beginTransaction();
        try{
            $group = GroupInventory::create([
                'name'  => $this->group_name,
                'price' => $this->group_price,
            ]);

            foreach ($this->summary as $inventory_type => $summaries) {
                foreach ($summaries as $summary) {
                    $quantity = $summary['details']['quantity'];

                    if ($inventory_type === 'liquids') {
                        // 🔹 Liquids branch
                        $inventory = LiquidInventory::where(
                            'liquid_nic_strength_id',
                            $summary['id']
                        )->first();
                        // $inventory->decrement('stock_received',$quantity);
                        GroupInventoryDetails::create([
                            'source'    => $inventory_type,
                            'liquid_id' => $inventory?->id,
                            'quantity'  => $quantity,
                            'group_id'  => $group->id,
                        ]);

                    } else {
                        // 🔹 Devices, Tanks, Cartridges, Coils → all DeviceInventories
                        $column = $inventory_type === 'devices'
                            ? $summary['details']['deviceTypeId']
                            : $summary['fk'];

                        $inventory = DeviceInventories::where(
                            $column,
                            $summary['id']
                        )->first();
                        // $inventory->decrement('stock_quantity',$quantity);
                        GroupInventoryDetails::create([
                            'source'     => $inventory_type,
                            'devices_id' => $inventory?->id,
                            'quantity'   => $quantity,
                            'group_id'   => $group->id,
                        ]);
                    }
                }
            }

            DB::commit();
        }
        catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
        $this->dispatch('creation_done');
    }

    public function addItem(string $selectedItem){
        $this->selectedItem = $selectedItem ;
        $this->dispatch('initalize_items',[$this->selectedItem]);
    }

  

    #[On('itemAdded')]
    public function itemAdded($new_quantities)
    {
        // Update existing items or add new ones (this prevents duplication)
        foreach ($new_quantities as $itemId => $itemData) {
            $this->quantities[$itemId] = $itemData; // This will overwrite existing or add new
        }
        $this->buildSummary();
    }

    protected function cleanQuantities()
    {
        // Keep only numeric keys (strength IDs) and remove string keys (input names)
        $this->quantities = collect($this->quantities)
            ->filter(function($value, $key) {
                return $key && is_array($value) ;
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
                            'id' => $details['id'],
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
                    
                    $deviceInventoryDetails = DeviceInventories::where($details['deviceTypeId'], $details['id'])->first();
                    if($deviceInventoryDetails){
                        $summary['devices'][] = [
                            'id' => $details['id'],
                            'name' => $deviceInventoryDetails->deviceDetails()['name'],
                            'details' => $details,
                        ];
                    }
                   
                    break;
                case 'tanks':
                    $tankInventoryDetails = DeviceInventories::where('tank_color_id' , $details['id'])->first();
                    

                    // dd($tankInventoryDetails->tankDetails()['name']);
                    if($tankInventoryDetails){
                        $summary['tanks'][] = [
                            'id' => $details['id'],
                            'name' => $tankInventoryDetails->tankDetails()['name'],
                            'fk'=>'tank_color_id',
                            'details' => $details,
                        ];
                    }
                    break;
                case 'cartridges':
                    $cartridgeInventoryDetails = DeviceInventories::where('cartridge_variant_id' , $details['id'])->first();
                    // dd($tankInventoryDetails->tankDetails()['name']);
                    if($cartridgeInventoryDetails){
                        $summary['cartridges'][] = [
                            'id' => $details['id'],
                            'name' => $cartridgeInventoryDetails->cartridgeDetails()['name'],
                            'fk'=>'cartridge_variant_id',
                            'details' => $details,
                        ];
                    }
                    break;
                case 'coils':
                    $coilInventoryDetails = DeviceInventories::where('coil_id' , $details['id'])->first();
                    // dd($tankInventoryDetails->tankDetails()['name']);
                    if($coilInventoryDetails){
                        $summary['coils'][] = [
                            'id' => $details['id'],
                            'name' => $coilInventoryDetails->coilSeriesDetails()['name'],
                            'fk'=>'coil_id',
                            'details' => $details,
                        ];
                    }
                    break;
            }
            }catch(Exception $e){
                dd($e->getMessage() , $this->quantities , $id , $details['source']);
            }
            

        }
      
        $this->summary = $summary;
    }
    

    public function showSummary(){
        dd($this->summary);
    }
    


    public function render()
    {
        return view('livewire.group-inventories.form');
    }
}
