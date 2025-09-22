<?php

namespace App\Livewire\sales;

use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use App\Models\Tanks\Tanks;
use App\Models\Tanks\TanksColors;
use Livewire\Attributes\On;
use Livewire\Component;

class TanksSelector extends Component
{
    public $selectedBrand ,$selectedTank ;
    public $brands=[] , $tanks=[] , $selectedTanks=[] , $quantities=[];
    public function mount(){
        $this->brands = DeviceBrands::withCount('tanks')->has('tanks')->get();
    }
    public function onBrandChanged(){
        $this->tanks = Tanks::where('brand_id',$this->selectedBrand)->get();
    }
    public function onTankChanged(){
        $this->selectedTanks = DeviceInventories::where('tank_id',$this->selectedTank)->get();
    }
    public function updatedQuantities($value , $key){   
        // value:Quantity , $key:21_6[$tankId , $deviceInventoryId];
        
        $deviceInventoryId = explode('_',$key)[1];
        if($deviceInventoryId){
            // Get base price for this strength
            $basePrice = DeviceInventories::where('id', $deviceInventoryId)
                ->where('status', 'in_stock')
                ->value('base_price');
            
            // Convert existing quantities to collection if it's not already
            $existingQuantities = collect($this->quantities);
            
            // Update or add the new quantity data
            $this->quantities = $existingQuantities->put($deviceInventoryId, [
                'id'=>$deviceInventoryId ,
                'quantity'    => $value,
                'base_price'  => $basePrice,
                'total_price_per_item' => $basePrice * $value,
                'source' => 'tanks' ,
            ])->toArray();
        }
        $this->dispatch('itemAdded', $this->quantities);
    }

    #[On('resetQuantities')]
    public function resetQuantities(){
        $this->reset('quantities','tanks','selectedTanks');
    }
    public function render()
    {
        return view('livewire.sales.tanks-selector');
    }
}
