<?php

namespace App\Livewire\DevicesBrands\CartridgesDetails;

use App\Models\Cartidges\Cartidge;
use App\Models\Cartidges\CartidgeVariants;
use App\Traits\UpdateItemsMethods;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    use UpdateItemsMethods;
    public $cartridge , $variants ,
    $name, $type, $capacity_ml, $description, $has_resistance, $material, $coil_type, $category_id, $brand_id ;
    public $images , $existingImages ; 
    public function mount($id){
        $this->loadCartridge($id);
    }
    private function loadCartridge($id){
        $this->cartridge = Cartidge::with(['category','brand','variants','images'])->where('id',$id)->first();
        $this->category_id = 9;
        $this->loadFields(type: 'cartridges' , model: $this->cartridge); // TRAITS ; 
    }

     public function update(){
        try{
            DB::transaction(function(){
                $this->cartridge->update(['name'=>$this->name , 'type'=>$this->type, 
                'capacity_ml'=>$this->capacity_ml, 'description'=>$this->description
                , 'has_resistance'=>$this->has_resistance, 'material'=>$this->material, 'coil_type'=>$this->coil_type]);
                $this->uploadImages();
                $this->updateVariants();
                $this->dispatch('editFormCancelled');
            });
        }catch(Exception $e){
            dd($e);
        }
    }
    private function updateVariants(){
        $this->cartridge->variants()->delete();  
        foreach($this->variants as $index=>$details){
            CartidgeVariants::create([
            'resistance'=>$details['resistance'] , 
            'vaping_style'=>$details['vaping_style'] , 
            'cartridge_id'=>$this->cartridge->id]);
        } 
    }
    
    public function render()
    {
        return view('livewire.devices-brands.cartridges-details.edit');
    }
}
