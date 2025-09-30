<?php

namespace App\Livewire\DevicesBrands\CoilsDetails;

use App\Models\Coils\Coils;
use App\Models\Coils\CoilSeries;
use App\Traits\UpdateItemsMethods;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    use UpdateItemsMethods ; 
    public $coilSeries , $category_id , $name , $description , $brand_id ,$variants; 
    public $images , $existingImages ; 
    public function mount($id){
        $this->loadCoil($id);
    }
    private function loadCoil($id){
        $this->coilSeries = CoilSeries::with(['category','brand','coilsOhms','images'])->where('id',$id)->first();
        $this->category_id = 7;
        $this->loadFields(type: 'coils' , model: $this->coilSeries); // TRAITS ; 
    }
    public function update(){
        try{
            DB::transaction(function(){
                $this->coilSeries->update(['name'=>$this->name , 'description'=>$this->description]);
                $this->uploadImages();
                $this->updateVariants();
                $this->dispatch('editFormCancelled');
            });
        }catch(Exception $e){
            dd($e);
        }
    }
    private function updateVariants(){
        $this->coilSeries->coilsOhms()->delete();  
        foreach($this->variants as $index=>$details){
            Coils::create([
            'name'=>$details['name'],'resistance'=>$details['resistance'] , 
            'wattage_range'=>$details['wattage_range'] , 
            'vaping_style'=>$details['vaping_style'] , 
            'description'=>$details['description'] , 'coil_series_id'=>$this->coilSeries->id]);
        } 
    }
    
    public function render()
    {
        return view('livewire.devices-brands.coils-details.edit');
    }
}
