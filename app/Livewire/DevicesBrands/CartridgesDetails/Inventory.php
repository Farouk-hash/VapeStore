<?php

namespace App\Livewire\DevicesBrands\CartridgesDetails;

use App\Models\Cartidges\Cartidge;
use App\Traits\InventoryItemsMethod;
use Livewire\Component;

class Inventory extends Component
{
    use InventoryItemsMethod ; 
    public $device ; 
    public function mount($id){
        $this->device = Cartidge::with(['brand','inventories'])->where('id',$id)->first();
        $this->initializeInventory('cartridges');
    }
    public function render()
    {
        return view('livewire.devices-brands.cartridges-details.inventory');
    }
}
