<?php

namespace App\Livewire\DevicesBrands\CoilsDetails;

use App\Models\Coils\CoilSeries;
use App\Traits\InventoryItemsMethod;
use Livewire\Component;

class Inventory extends Component
{
    use InventoryItemsMethod ; 
    public $device ; 
    public function mount($id){
        $this->device = CoilSeries::with(['brand'])->where('id',$id)->first();
        $this->initializeInventory('coils');
    }
    public function render()
    {
        return view('livewire.devices-brands.coils-details.inventory');
    }
}
