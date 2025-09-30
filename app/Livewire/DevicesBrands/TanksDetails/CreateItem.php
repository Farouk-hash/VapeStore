<?php

namespace App\Livewire\DevicesBrands\TanksDetails;

use App\Models\Hardware\DeviceBrands;


use App\Traits\CreateItemsMethods;
use Livewire\Component;

class CreateItem extends Component
{
    use CreateItemsMethods ; 
    public $brand , $tank ; 
    public $type , $vaping_style  ;

    public function mount($id){
        $this->brand = DeviceBrands::where('id',$id)->first();
        $this->initializeCreateFields('tanks',6);
    }
    
    
    
    public function render()
    {
        return view('livewire.devices-brands.tanks-details.create-item');
    }
}
