<?php

namespace App\Livewire\sales;

use App\Models\Cartidges\Cartidge;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use Livewire\Attributes\On;
use Livewire\Component;

class CartridgesSelector extends Component
{
    public $matchMode;
    public $selectedBrand ,$selectedCartridgeType , $selectedCartridgeMaterial, $selectedCartridgeCoilType , $selectedCartridge ,$selectedcartridges, $selectedVapingStyle;
    public $brands=[],$cartridges=[],$quantities=[],$cartridgeTypes=[],$cartridgeMaterials=[],$cartridgeCoilTypes=[],$vapingStyles=[];

    public function mount(){

        $this->cartridgeTypes=["refillable","prefilled","disposable"]; 
        $this->cartridgeMaterials=["PCTG","Glass","Pyrex Glass"];
        $this->cartridgeCoilTypes=["mesh","cotton","ceramic"];
        $this->vapingStyles=['MTL','RDL','DL'];

        $this->initializeBrands();
    }
    public function initializeBrands(){
        $this->brands = DeviceBrands::withCount('cartridges')->has('cartridges')->get(); 
    }
    public function onBrandChanged(){
        $this->cartridges = Cartidge::where('brand_id',$this->selectedBrand)->get();
    }
    // TYPE[refillable,prefilled,disposable] , MATERIAL [PCTG,Glass,Pyrex Glass] , COIL_TYPE[mesh,cotton,ceramic,]
    public function onSubChanged(){
        $query = Cartidge::query();
        $query->where(function($q) {
            if($this->matchMode==='any'){
                if($this->selectedCartridgeType){
                    $q->orWhere('type',$this->selectedCartridgeType);
                }
                if($this->selectedCartridgeMaterial){
                    $q->orWhere('material',$this->selectedCartridgeMaterial);
                }
                if($this->selectedCartridgeCoilType){

                    $q->orWhere('coil_type',$this->selectedCartridgeCoilType);
                }
                if($this->selectedVapingStyle) {
                    $q->orWhereHas('variants', function ($variantQuery) {
                        $variantQuery->where('vaping_style', $this->selectedVapingStyle);
                    });
                }
            }
            else{
                if($this->selectedCartridgeType){
                    $q->where('type',$this->selectedCartridgeType);
                }
                if($this->selectedCartridgeMaterial){
                    $q->where('material',$this->selectedCartridgeMaterial);
                }
                if($this->selectedCartridgeCoilType){
                    $q->where('coil_type',$this->selectedCartridgeCoilType);
                }
                if($this->selectedVapingStyle){
                    $q->whereHas('variants', function ($variantQuery) {
                        $variantQuery->where('vaping_style', $this->selectedVapingStyle);
                    });
                }
            }
        });
        
        $this->cartridges=$query->get();
        $brandIds=$query->distinct('brand_id')->pluck('brand_id')->toArray();
        $this->brands = DeviceBrands::whereIn('id',$brandIds)->get();
    }

    public function onReset(){
        $this->reset(['selectedCartridgeType','selectedCartridgeMaterial','selectedCartridgeCoilType','cartridges','selectedCartridge','selectedcartridges','selectedBrand']);
        $this->initializeBrands();
    }
    public function onCartridgeChanged(){
        $this->selectedcartridges = DeviceInventories::groupedByid('cartridge_id','cartridge_variant_id',$this->selectedCartridge);
        if(!$this->selectedBrand && $this->selectedcartridges->count() > 0){
            $this->selectedBrand = $this->selectedcartridges->first()->cartridge->brand->id ; 
        }  
    }
    public function updatedQuantities($value , $key){
        $deviceInventoryId = explode('_',$key)[1];
        if($deviceInventoryId){
            // Get base price for this strength
            $cartridgeDetails = DeviceInventories::where('id', $deviceInventoryId)
                ->where('status', 'in_stock')
                ->first();
            $basePrice = $cartridgeDetails->cartridgeDetails()['base_price'];
            $total_quantity = $cartridgeDetails->cartridgeDetails()['quantities'];
            // Convert existing quantities to collection if it's not already
            $existingQuantities = collect($this->quantities);
            
            // Update or add the new quantity data
            $this->quantities = $existingQuantities->put($deviceInventoryId, [
                'id'=>$deviceInventoryId ,
                'quantity'    => $value,
                'base_price'  => $basePrice,
                'total_quantity'=>$total_quantity , 
                'total_price_per_item' => $basePrice * $value,
                'source' => 'cartridges' ,
            ])->toArray();
        }
        $this->dispatch('itemAdded', $this->quantities);
    }
    #[On('resetQuantities')]
    public function resetQuantities(){
        $this->reset('quantities','cartridges','selectedcartridges');
        $this->initializeBrands();
    }
    public function render()
    {
        return view('livewire.sales.cartridges-selector');
    }
}
