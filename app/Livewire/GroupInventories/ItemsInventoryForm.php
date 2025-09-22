<?php

namespace App\Livewire\GroupInventories;

use App\Models\Cartidges\Cartidge;
use App\Models\Coils\CoilSeries;
use App\Models\CommonModels\Brand;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use App\Models\Hardware\Devices;
use App\Models\Tanks\Tanks;
use App\Models\Vape\Flavour;
use App\Models\Vape\LiquidInventory;
use Livewire\Attributes\On;
use Livewire\Component;

class ItemsInventoryForm extends Component
{
    public $brands = [] , $selectedItem , $selectedBrand  , $items  , $selectedProduct , $selectedProducts = []  ,$quantities=[] ;
    public $deviceTypeId=null ; 
    public function mount(string $selectedItem){
        $this->selectedItem = $selectedItem ; 
        $this->initializeBrands();
    }

    #[On('initalize_items')]
    public function initalize_items($selectedItem){
        $this->reset('items','brands','selectedBrand','selectedProduct','selectedProducts');
        $this->selectedItem = $selectedItem[0] ; 
        $this->initializeBrands();
    }

    protected function initializeBrands(){
        if($this->selectedItem !== 'liquids'){
            $this->brands = DeviceBrands::withCount([$this->selectedItem])->has($this->selectedItem)->get();
        }else{
            $this->brands = Brand::all();
        }

    }
    public function onBrandChanged(){
        if($this->selectedItem !== 'liquids'){
            $models = [
                'devices'=>Devices::class , 
                'tanks'=>Tanks::class , 
                'cartridges'=>Cartidge::class , 
                'coils'=>CoilSeries::class , 
            ];
            $this->items = $models[$this->selectedItem]::where('brand_id' , $this->selectedBrand)->get();               
        }
        else{
            $this->items = Flavour::where('brand_id',$this->selectedBrand)->get();
        }
    }
    
    public function onProductChanged(){
        if($this->selectedItem !=='liquids'){
            $this->selectedProducts = DeviceInventories::listBySource($this->selectedItem , $this->selectedProduct);
            if($this->selectedItem ==='devices' && count($this->selectedProducts)!=0){
                $this->deviceTypeId = $this->selectedProducts[0]['type'] ; 
            }
            return ; 
        }
        $this->selectedProducts = LiquidInventory::details($this->selectedProduct);
    }

    public function updatedQuantities($quantity , $value){
        $id = explode('_',$value)[0];

        // dd($id , $value , $this->selectedProducts);
        if($this->selectedItem !=='liquids'){
            // Convert existing quantities to collection if it's not already
            $existingQuantities = collect($this->quantities);
            
            // Update or add the new quantity data
            $this->quantities = $existingQuantities->put((string)$id.$this->selectedItem, [
                'id'=>$id ,
                'quantity'    => $quantity ,                
                'deviceTypeId'=>$this->deviceTypeId , 
                
                'source' => $this->selectedItem ,
            ])->toArray();
        }
        else{
            $id = explode('_',$value)[0];     
            // Convert existing quantities to collection if it's not already
            $existingQuantities = collect($this->quantities);
            
            // Update or add the new quantity data
            $this->quantities = $existingQuantities->put((string)$id.$this->selectedItem, [
                'id'=>$id ,
                'quantity'    => $quantity ,
                'source' => $this->selectedItem ,
            ])->toArray();
        }
        $this->dispatch('itemAdded', $this->quantities);
    }

   

    public function render()
    {
        return view('livewire.group-inventories.items-inventory-form');
    }
}
