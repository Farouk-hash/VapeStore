<?php

namespace App\Livewire\DevicesBrands\TanksDetails;

use App\Models\Tanks\Tanks;
use App\Traits\InventoryItemsMethod;
use Livewire\Component;

class Inventory extends Component
{
    use InventoryItemsMethod;
    public $device ; 
    public function mount($id){
        $this->device = Tanks::with(['brand'])->where('id',$id)->first();
        $this->initializeInventory('tanks');
    }
    
    public function render()
    {
        return view('livewire.devices-brands.tanks-details.inventory');
    }
}
