<?php

namespace App\Livewire\DevicesBrands\ItemsDetails;

use App\Models\Hardware\DeviceColors;
use App\Models\Hardware\DeviceFlavors;
use App\Models\Hardware\DeviceInventories;
use App\Models\Hardware\Devices;
use App\Traits\InventoryItemsMethod;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Inventory extends Component
{
    use InventoryItemsMethod;
    public $device ; 
    public function mount($id){
        $this->device = Devices::with(['brand'])->where('id',$id)->first();
        $this->initializeInventory('devices');
    }
    
        public function render()
    {
        return view('livewire.devices-brands.items-details.inventory');
    }
}
