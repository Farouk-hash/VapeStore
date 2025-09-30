<?php

namespace App\Livewire\LiquidsBrands;

use App\Models\CommonModels\Brand;
use DB;
use Livewire\Component;

class BrandsShow extends Component
{
    public $brands ;
    public function mount(){
        $this->initializeBrands();
    }
    protected function initializeBrands(){
        $this->brands = Brand::withCount(['flavours'])->get();

    }
     public function editBrandForm($id){
        // $brand = $this->brands->where('id',$id)->first();
        $this->dispatch('editBrandForm',$id);
    }
    
    public function deleteBrand($id){
        Brand::where('id',$id)->delete();
        $this->initializeBrands();
    }

    public function changeActivation($id){
        Brand::where('id',$id)->update(['is_active'=>DB::raw('NOT is_active')]);
        $this->initializeBrands();
    }
    public function showDetails($id){
        $this->dispatch('showDetailsEvent',$id);
    }
    public function render()
    {
        return view('livewire.liquids-brands.brands-show');
    }
}
