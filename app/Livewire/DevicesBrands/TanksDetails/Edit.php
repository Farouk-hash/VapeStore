<?php

namespace App\Livewire\DevicesBrands\TanksDetails;

use App\Models\Image\Image;
use App\Models\Tanks\Tanks;
use App\Traits\UpdateItemsMethods;
use App\Traits\UploadingImageTraits;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use UpdateItemsMethods ; 
    public $tank , $name , $type , $vaping_style , $release_year ,$selectedCategory ; 
    public $colorFields , $specFields , $existingImages , $images ; 
    public function mount($id){
        $this->loadTank($id);
    }
    private function loadTank($id){
        $this->tank = Tanks::with(['speces','category','brand','colors','images'])->where('id',$id)->first();
        $this->selectedCategory = 6;
        $this->loadFields(type: 'tanks' , model: $this->tank); // TRAITS ; 
    }
    
   

    public function update()
    {
        // $this->validate();
        try {
            DB::transaction(function () {
                // Update Basic Information
                $this->tank->update([
                    'name' => $this->name,
                    'release_year' => $this->release_year,
                    // 'sku' => $this->sku,
                    // 'description' => $this->description,
                    'type'=> $this->type,
                    'vaping_style'=>$this->vaping_style                    
                ]);
                // TRAITS [colors , specifications , images] ; 
                $this->updateColors('value');
                // Update Specifications
                $this->updateSpecifications();
                // Upload New Images
                $this->uploadImages();

            });

            session()->flash('success', 'Tanks updated successfully');
            $this->dispatch('editFormCancelled'); 
        }
        catch (Exception $e) {
            dd($e->getMessage() , $this->specFields);
            session()->flash('error', 'Error updating device: ' . $e->getMessage());
        }
    }
    
   
    public function render()
    {
        return view('livewire.devices-brands.tanks-details.edit');
    }
}
