<?php

namespace App\Livewire\LiquidsBrands\ItemsDetails;

use App\Models\Image\Image;
use App\Models\Vape\Flavour;
use App\Models\Vape\Liquid;
use App\Models\Vape\LiquidNicStrength;
use Livewire\Component;

class Details extends Component
{
    public $liquid ,$images , $flavour , $selectedNicStrenghts=false; 
    public $activeImageIndex = 0,$forceDetails; 
    public function mount($id,$forceDetails=null){
        $this->forceDetails=$forceDetails;
        $this->flavour = Flavour::where('id',$id)->first();
        $this->images = $this->flavour->images()->pluck('url')->toArray();
    }
   
    public function getdNicStrenghts($id){
        $this->selectedNicStrenghts = true ; 
        $liquid = LiquidNicStrength::where('liquid_id',$id)->get();
        $this->liquid = $liquid->map(function($l){
            return [
                'id'=>$l->id , 
                'strength'=>$l->strength , 
                'inventories'=>$l->inventories ,
            ];
        });
    }
    public function setActiveImage($index){
        $this->activeImageIndex = $index ; 
    }
    public function cancel(){
        $this->dispatch('cancelDetails');
    }
    public function render()
    {
        return view('livewire.liquids-brands.items-details.details');
    }
}
