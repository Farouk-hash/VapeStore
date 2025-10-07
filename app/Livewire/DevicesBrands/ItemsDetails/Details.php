<?php

namespace App\Livewire\DevicesBrands\ItemsDetails;

use App\Models\Hardware\Devices;
use App\Traits\GetItemDetails;
use Livewire\Component;

class Details extends Component
{
    use GetItemDetails;
    public $device , $colors=false , $features=false , $flavors=false , $specifications=false ,$puffs=false ; 
    public $activeImageIndex = 0  , $category_id , $forceDetails; 
    public function mount($id , $forceDetails = null){
        $this->forceDetails = $forceDetails  ;
        $this->device = Devices::with(['speces','puffs','colors','flavors','features','images'])
        ->where('id',$id)->first();
        // dd($this->device->inventories);
        $this->category_id = $this->device->category_id ; 
        $this->loadAttributes('devices',$this->category_id);
        // dd($this->device->inventories);
        // dd($this->device->inventories);
    }
       public function render()
    {
        return view('livewire.devices-brands.items-details.details');
    }
}
