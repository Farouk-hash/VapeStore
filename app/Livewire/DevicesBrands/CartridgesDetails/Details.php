<?php

namespace App\Livewire\DevicesBrands\CartridgesDetails;

use App\Models\Cartidges\Cartidge;
use App\Traits\GetItemDetails;
use Livewire\Component;

class Details extends Component
{
    use GetItemDetails;
    public $variants=false   ,$device ; 
    public function mount($id){
        $this->device = Cartidge::with(['variants','brand','category','images'])->where('id',$id)->first();
        // dd($this->device->inventories);
        $this->loadAttributes('cartridges');
    }
    public function render()
    {
        return view('livewire.devices-brands.cartridges-details.details');
    }
}
