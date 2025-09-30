<?php
namespace App\Traits;

use App\Models\Image\Image;
use Livewire\WithFileUploads;

trait UpdateItemsMethods{
    use WithFileUploads , UploadingImageTraits ; 
    public $model , $folderName ; 
    private function attributes($type){
        $commonAttributes = [
            'tanks'=>['name','type','vaping_style','release_year','category_id'] , 
            'devices'=>['name','release_year','sku','description','category_id'],
            'coils'=>['name','description','category_id','brand_id'],
            'cartridges'=>['name', 'type', 'capacity_ml', 'description', 'has_resistance', 'material', 'coil_type', 'category_id', 'brand_id'] ,
        ];
        return $commonAttributes[$type];
    }

    private function loadFields($type , $model){
        $this->model = $model ; 
        $this->folderName = $type;

        foreach($this->attributes($type) as $field){
            $this->{$field} = $this->model->{$field};
        }

        // Category 2 Special Fields For Disposables ; 
        if($this->category_id == 2 && $type === 'devices'){
            $this->devicePuffs = $this->model->puffs()->first() ; 
            $this->device_puffs = $this->devicePuffs->value;
            $this->device_puffs_nicotine_strength = $this->devicePuffs->nicotine_strength;
            $this->device_puffs_nicotine_type = $this->devicePuffs->nicotine_type;
            $this->device_puffs_ice_type = $this->devicePuffs->ice_type;
        }

        $this->loadDynamicFields();
        $this->loadExistingImages();
    }

    private function loadDynamicFields(){
        // dd($this->model);
        
        // Features , Colors (if it's a device)
        if ($this->folderName === 'devices') {
            $this->colorFields = $this->model->colors->pluck('name')->toArray();
            $this->featureFields = $this->model->features->pluck('name')->toArray();
            $this->flavorFields = $this->model->flavors->pluck('id')->toArray();
        }
        elseif($this->folderName === 'tanks') {
            $this->colorFields = $this->model->colors->pluck('value')->toArray();
        }
        
        if(in_array($this->folderName , ['devices','tanks'])){
            // Specifications[Devices , Tanks];
            $this->specFields = [];
            foreach ($this->model->speces as $spec) {
                $this->specFields[] = [
                    'key' => $spec->spec_key,
                    'value' => $spec->spec_value
                ];
            }
        }
        elseif($this->folderName === 'coils'){
            $this->variants = [];
            foreach($this->model->coilsOhms as $ohm){
                $this->variants[] = [
                    'name'=>$ohm->name ,
                    'resistance'=>$ohm->resistance , 
                    'wattage_range'=>$ohm->wattage_range , 
                    'vaping_style'=>$ohm->vaping_style , 
                    'description'=>$ohm->description , 
                    'coil_series_id'=>$ohm->coil_series_id
                ];
            }
        }elseif($this->folderName==='cartridges'){
            $this->variants= [];
            foreach($this->model->variants as $var){
                $this->variants[]=[
                    'resistance' => $var->resistance ,
                    'vaping_style' => $var->vaping_style , 
                ];
            }
        }
    }

    private function loadExistingImages(){
        $this->existingImages = $this->model->images;
        // dd($this->existingImages);
    }

    // DEVICES , TANKS ;
    public function addColorField()
    {
        $this->colorFields[] = '';
    }

    public function removeColorField($index)
    {
        if (count($this->colorFields) > 1) {
            unset($this->colorFields[$index]);
            $this->colorFields = array_values($this->colorFields);
        }
    }


    // COILS ; 
    public function addCoilVairants(){
        $this->variants[] = [
            'name'=>'' ,
            'resistance'=>'' , 
            'wattage_range'=>'', 
            'vaping_style'=>'' , 
            'description'=>'' , 
            'coil_series_id'=>''
        ];
    }
    public function removeCoilVairants($index){
        if(count($this->variants)>0){
            unset($this->variants[$index]);
            $this->variants = array_values($this->variants);
        }
    }

    // CARTRIDGES ; 
    public function addCartridgeVairants(){
        $this->variants[] = [
            'resistance'=>'' , 
            'vaping_style'=>'' , 
        ];

    }
    public function removeCartridgeVairants($index){
        if(count($this->variants)>0){
            unset($this->variants[$index]);
            $this->variants = array_values($this->variants);
        }
    }

    // Specification Methods
    public function addSpecField()
    {
        $this->specFields[] = ['key' => '', 'value' => ''];
    }

    // Image Methods
    public function removeExistingImage($imageId)
    {
        $url = Image::where('id',$imageId)->value('url');
        $this->deleteImage(
        [$url], $this->folderName , 'public', $this->model->id,
        get_class($this->model));
        $this->loadExistingImages();
    }

    private function uploadImages(){
        // dd($this->folderName, get_class($this->model));
        $this->uploadImage(
            source: $this->images,
            input_name: 'images',
            foldername: $this->folderName , 
            disk: 'public',
            imageable_id: $this->model->id,
            imageable_type: get_class($this->model),
        );
    }


    public function removeSpecField($index)
    {
        if (count($this->specFields) > 1) {
            unset($this->specFields[$index]);
            $this->specFields = array_values($this->specFields);
        }
    }

    public function removeImage($index)
    {
        if (isset($this->images[$index])) {
            unset($this->images[$index]);
            $this->images = array_values($this->images);
        }
    }

    private function updateColors($key='name')
    {
        $this->model->colors()->delete();
        foreach ($this->colorFields as $color) {
            if (!empty(trim($color))) {
                $this->model->colors()->create([$key => trim($color)]);
            }
        }
    }

    private function updateSpecifications()
    {
        $this->model->speces()->delete();
        foreach ($this->specFields as $spec) {
            if (!empty(trim($spec['key'])) && !empty(trim($spec['value']))) {
                $this->model->speces()->create([
                    'spec_key' => trim($spec['key']),
                    'spec_value' => trim($spec['value'])
                ]);
            }
        }
    }

    public function cancelEdit()
    {
        $this->dispatch('editFormCancelled');
        
    }

}