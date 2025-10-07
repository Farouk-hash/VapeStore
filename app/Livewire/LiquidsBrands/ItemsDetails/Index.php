<?php

namespace App\Livewire\LiquidsBrands\ItemsDetails;

use App\Models\CommonModels\Brand;
use App\Models\Vape\Liquid;
use Livewire\Attributes\On;
use Livewire\Component;


class Index extends Component
{
    
    public $showFlavorFormVariable = false , $showEditForm = false , $showInventoryForm = false , $showDetails=false ; 
    public $brand,$forceDetails ;
    public $id ;  
    public function mount($itemId ,$forceDetails=null){
        // $this->brand = Brand::where('id',$itemId)->first();
        $this->forceDetails = $forceDetails;
        if(isset($forceDetails)){
            $liquid= Liquid::with('flavour.brand')
            ->where('id',$itemId)
            ->first()->flavour;
            $itemId = $liquid->id ; 
            $this->brand = $liquid->brand;
            $this->getDetails($itemId);
        }else{
            $this->brand = Brand::where('id',$itemId)->first();
        }
        // dd($this->brand);
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