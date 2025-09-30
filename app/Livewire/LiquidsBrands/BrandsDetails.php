<?php

namespace App\Livewire\LiquidsBrands;

use App\Models\CommonModels\Brand;
use Livewire\Component;

class BrandsDetails extends Component
{
    public $brand  ; 
    public $addFlavorFormContainer = false;

    public function mount($itemID){
        $this->brand = Brand::where('id',$itemID)->first();
    }
    public function showFlavorFormContainer(){
        $this->addFlavorFormContainer = true;
    }
    public function saveFlavorBtn(){

    }
    public function cancelFlavorBtn(){

    }
    public function render()
    {
        return view('livewire.liquids-brands.brands-details');
    }
}
