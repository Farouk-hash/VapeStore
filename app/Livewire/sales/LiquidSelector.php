<?php

namespace App\Livewire\sales;

use App\Models\CommonModels\Brand;
use App\Models\CommonModels\Category;
use App\Models\Vape\Flavour;
use App\Models\Vape\FlavourComponent;
use App\Models\Vape\Liquid;
use App\Models\Vape\LiquidInventory;
use Livewire\Attributes\On;
use Livewire\Component;

class LiquidSelector extends Component
{
    public $selectedBrand, $selectedFlavor, $selectedLiquids = [], $liquidId , $selectedCategory ;
    public $quantities = [] , $summary = [] , $brands =[] , $flavors=[] , $categories=[] , 
    $components=[] , $filteredComponents = [] , $selectedComponents = [] , $selectedFlavorsComponents = []; 
    public $showSummary = false , $resetCategories = false  ; 

    public function mount()
    {
        $this->categories = Category::with(['components'])->get(['id','name']);
        $this->components = $this->categories->pluck('components')
        ->flatten()->map(function($component){
            return ['id'=>$component->id , 'name'=>$component->name , 'category_id'=>$component->category_id];
        })->values();
        $this->initalizeBrands();
    }

    protected function initalizeBrands(){
        if($this->selectedFlavorsComponents && count($this->selectedFlavorsComponents) > 0){
            $this->brands = Brand::whereHas('flavours', function($query) {
                $query->whereIn('id', $this->selectedFlavorsComponents );
            })->get(['id', 'name']);
        }else{
            $this->brands = Brand::all(['id','name']);
        }
    }

    public function onCategoryChanged(){
        $this->filteredComponents = 
        collect($this->components)->where('category_id', $this->selectedCategory)->values()->toArray();
    }

    public function onComponentsChanged(){
        $this->selectedFlavorsComponents = FlavourComponent::whereIn('component_id',$this->selectedComponents)->pluck('flavour_id')->toArray();
        $this->initalizeBrands();
    }

    public function onResetCategories(){
        $this->resetCategories = !$this->resetCategories ; 
        if($this->resetCategories){
            $this->filteredComponents = [];
            $this->selectedCategory = null ; 
            $this->selectedFlavorsComponents = [];
            $this->initalizeBrands();
        }
    }
    public function onBrandChanged()
    {
        $this->flavors = Flavour::where('brand_id', $this->selectedBrand)->get();
    }

    public function onFlavorChanged()
    {
        $this->selectedLiquids = Liquid::with(['strengthNic.inventories'])
        ->where('flavour_id', $this->selectedFlavor)
        ->get();    
    }

   
    public function updatedQuantities($value, $key)
    {
        // Extract strength_id from the changed key
        $parts = explode('_', $key);
        $strengthId = $parts[1] ?? null;
        
        if ($strengthId) {
            // Get base price for this strength
            $liquidInventoryDetails = LiquidInventory::where('liquid_nic_strength_id', $strengthId)
                ->where('is_active', 1)
                ->first(['base_price','id']);
            // Convert existing quantities to collection if it's not already
            $existingQuantities = collect($this->quantities);
            
            // Update or add the new quantity data
            $this->quantities = $existingQuantities->put($strengthId, [
                'id'=>$liquidInventoryDetails->id,
                'quantity'    => $value,
                'base_price'  => $liquidInventoryDetails->base_price,
                'total_price_per_item' => $liquidInventoryDetails->base_price * $value,
                'source' => 'liquids' ,
            ])->toArray();
        }
        // EMIT EVENT TO SALES-PAGE LOADING $this->quantities ;
        $this->dispatch('itemAdded', $this->quantities);
    }
    
    #[On('resetQuantities')]
    public function resetQuantities(){
        $this->onResetCategories();
    }
   

    // public function onShowingSummary(){
    //     $this->showSummary = !$this->showSummary ; 
    //     if($this->showSummary){
    //         $this->buildSummary();
    //     }
    // }
  

  

    public function render()
    {
        return view('livewire.sales.liquid-selector');
    }
}
