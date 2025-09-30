<?php

namespace App\Livewire\DevicesBrands\CartridgesDetails;

use App\Models\Hardware\DeviceBrands;
use App\Traits\CreateItemsMethods;
use Livewire\Component;

class CreateItem extends Component
{
    use CreateItemsMethods;
    public $type, $capacity_ml, $description, $has_resistance, $material, $coil_type , $brand;
    public $cartidgeVariants=[];
    public function mount($id){
        $this->brand = DeviceBrands::where('id',$id)->first();
        $this->initializeCreateFields('cartridges',9);
    }
    public function render()
    {
        return view('livewire.devices-brands.cartridges-details.create-item');
    }
}
