<?php

namespace App\Livewire\LiquidsBrands;

use App\Models\CommonModels\Brand;
use Livewire\Component;

class BrandsEditForm extends Component
{
    public $brand , $name , $description , $country , $is_active ;

    public function mount($id){
        $this->brand = Brand::where('id',$id)->first();
        $this->name = $this->brand->name ; 
        $this->description = $this->brand->description ; 
        $this->country = $this->brand->country;
        $this->is_active = $this->brand->is_active ;
    }
    
    public function submit(){
        $this->brand->update(['name'=>$this->name , 'description'=>$this->description , 'country'=>$this->country]);
        $this->dispatch('editingDone');
    }
    public function render()
    {
        return view('livewire.liquids-brands.brands-edit-form');
    }
}
