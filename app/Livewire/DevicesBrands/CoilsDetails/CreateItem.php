<?php

namespace App\Livewire\DevicesBrands\CoilsDetails;

use App\Models\Hardware\DeviceBrands;
use App\Traits\CreateItemsMethods;
use Livewire\Component;

class CreateItem extends Component
{
    use CreateItemsMethods ; 
    public $coilVariants = [] , $brand ;
    public function mount($id){
        $this->brand = DeviceBrands::where('id',$id)->first();
        $this->initializeCreateFields('coils',7);
    }
    
    public function render()
    {
        return view('livewire.devices-brands.coils-details.create-item');
    }
}
