<?php

namespace App\Livewire\LiquidsBrands\ItemsDetails;

use App\Models\CommonModels\Brand;
use App\Models\Vape\Flavour;
use App\Models\Vape\Liquid;
use App\Models\Vape\LiquidNicStrength;
use App\Traits\UploadingImageTraits;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads , UploadingImageTraits ; 
    
    public $flavour , $brands , $components , $name, $brand_id , $component_ids=[] ;
    public $selectedNicStrenghts =false , $nicStrenghts = [] , $selectedNicStrenghtId , $strengthInput;
    public $showLiquidProperty = false  , $nicotine_type  , $vape_style , $vappingStyles , $nicTypes ,
    $showCustomVgPg=false , $vgPgRatio , $bottleSize , $customPg , $customVg ;
    public $images , $oldImages ;

    public function updatedVgPgRatio($value){
        if($value == 'custom') {
            $this->showCustomVgPg = true ; 
            return ; 
        }
        $this->showCustomVgPg = false ; 
    }
    
    public function addLiquidProperties(){
        Liquid::create([
        'vape_style'=>$this->vape_style , 'vg_pg_ratio'=>$this->vgPgRatio,
        'bottle_size_ml'=>$this->bottleSize , 
        'nicotine_type'=>$this->nicotine_type , 'flavour_id'=>$this->flavour->id]);
        $this->reset('showLiquidProperty' , 'nicotine_type' , 'vape_style');
        // dd($this->vgPgRatio , $this->nicotine_type , $this->vape_style , $this->bottleSize);
    }

    public function mount($id){
        $this->brands = Brand::get();

        $this->components = \App\Models\CommonModels\Component::get();
        $this->flavour = Flavour::with(['liquids'])->where('id',$id)->first();
        $this->name = $this->flavour->name ;
        $this->brand_id= $this->flavour->brand_id ; 
        
        $this->vappingStyles = ['MTL', 'DL', 'SALTNic'];
        $this->nicTypes = ['FreeBase', 'Salt', 'DL'];
    
        $this->component_ids = $this->flavour->components->pluck('id')->toArray();
        $this->initializeOldImages();
    }
    
    public function updateFlavour()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brand,id',
            'component_ids' => 'array',
            'component_ids.*' => 'exists:component,id'
        ]);
        
        try {
            // Update flavour
            $this->flavour->update([
                'name' => $this->name,
                'brand_id' => $this->brand_id,
            ]);
            
            // Sync components (many-to-many relationship)
            $this->flavour->components()->sync($this->component_ids);
            
            // Dispatch event or show success message
            $this->dispatch('flavour-updated', message: 'Flavour updated successfully!');
            
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function getdNicStrenghts($id){
        $this->selectedNicStrenghts = true ; 
        $this->nicStrenghts = LiquidNicStrength::where('liquid_id' , $id)->get();
        $this->selectedNicStrenghtId = $id;  
    }
    public function removeLiquidProperty($id){
        Liquid::where('id' , $id)->delete();
    }
    public function removeStrength($id){
        LiquidNicStrength::where('id' , $id)->delete();
        $this->getdNicStrenghts($this->selectedNicStrenghtId);
    }
    public function addStrengthBtn(){
        if(!$this->strengthInput ) return ; 
        LiquidNicStrength::create(['strength'=>$this->strengthInput , 'liquid_id'=>$this->selectedNicStrenghtId]);
        $this->reset('strengthInput');
        $this->getdNicStrenghts($this->selectedNicStrenghtId);
    }

    public function saveImages(){
        $this->uploadImage(
            source: $this->images,
            input_name: 'images',
            foldername: 'flavors' , 
            disk: 'public',
            imageable_id: $this->flavour->id,
            imageable_type: get_class($this->flavour),
        );
        $this->reset('images');
        $this->initializeOldImages();
    }

    public function removeImage($id , $url=null){
        if($url){
            $this->deleteImage([$url], 'flavors', 'public', $this->flavour->id,
             get_class($this->flavour));
            $this->initializeOldImages();
            return ; 
        }
        unset($this->images[$id]);
    }
    public function initializeOldImages(){
        $this->oldImages = $this->flavour->images;
    }
    public function cancel()
    {
        $this->dispatch('flavour-updated', message: 'Flavour updated successfully!');
    }

    public function render()
    {
        return view('livewire.liquids-brands.items-details.edit');
    }
}
