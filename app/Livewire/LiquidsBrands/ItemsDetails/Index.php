<?php

namespace App\Livewire\LiquidsBrands\ItemsDetails;

use App\Models\CommonModels\Brand;
use Livewire\Attributes\On;
use Livewire\Component;


class Index extends Component
{
    
    public $showFlavorFormVariable = false , $showEditForm = false , $showInventoryForm = false , $showDetails=false ; 
    public $brand ;
    public $id ;  
    public function mount($itemId){
        $this->brand = Brand::where('id',$itemId)->first();
    }

    #[On('hideFlavorFormVariable')]
    public function hideFlavorFormVariable(){
        $this->showFlavorFormVariable = false ; 
    }
    public function edit($id){
        $this->id = $id ; 
        $this->showEditForm = true ; 
    }
    public function inventory($id){
        $this->id = $id ; 
        $this->showInventoryForm = true ; 
    }
    #[On('flavour-updated')]
    public function flavour_updated(){
        $this->showEditForm = false ; 
    }
    
    #[On('cancelInventory')]
    public function cancelInventory(){
        $this->showInventoryForm = false ; 
    }
    
    #[On('cancelDetails')]
    public function cancelDetails(){
        $this->showDetails = false ; 
    }
    public function getDetails($id){
        $this->id = $id ; 
        $this->showDetails = true ; 
    }
    
    public function render()
    {
        return view('livewire.liquids-brands.items-details.index');
    }
}