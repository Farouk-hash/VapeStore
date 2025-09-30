<?php

namespace App\Livewire\DevicesBrands;

use App\Models\Hardware\DeviceBrands;
use Livewire\Component;

class BrandsEditForm extends Component
{
    public $brand , $name , $description , $country , $is_active;
    public function mount($id){
        $this->brand = DeviceBrands::where('id',$id)->first();
        $this->name = $this->brand->name ; 
        $this->description = $this->brand->description ; 
        $this->country = $this->brand->country;
        $this->is_active = $this->brand->is_active ;
    }
    public function submit(){
        $this->brand->update(['name'=>$this->name , 'description'=>$this->description , 'country'=>$this->country , 'is_active'=>$this->is_active]);
        $this->dispatch('editingDone');
    }
    public function render()
    {
        return view('livewire.devices-brands.brands-edit-form');
    }
}
