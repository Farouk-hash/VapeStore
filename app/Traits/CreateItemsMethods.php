<?php 
namespace App\Traits;

use App\Models\Cartidges\CartidgeVariants;
use App\Models\Coils\Coils;
use App\Models\Hardware\DeviceFeatures;
use App\Models\Hardware\DeviceFlavors;
use App\Models\Hardware\DevicePuffs;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;


trait CreateItemsMethods{
    use WithFileUploads , UploadingImageTraits ; 
    public $name , $description , $release_year , $sku ;
    public $images=[] , $colorFields = [], $specFields = [] ; 
    public $category_id ,$itemType , $modelItem ;

    public function getItemsAttributes($itemType){
        $attributes=[
            'devices'=>[
                'model'=>\App\Models\Hardware\Devices::class ,
                'color_model'=>['model'=>\App\Models\Hardware\DeviceColors::class, 'pk'=>'device_id' , 'sk'=>'name'] ,
                'spec_model'=>['model'=>\App\Models\Hardware\DevicesSpecs::class, 'pk'=>'device_id' ] , 
 
            ],
            'tanks'=>[
                'model'=>\App\Models\Tanks\Tanks::class , 
                'color_model'=>['model'=>\App\Models\Tanks\TanksColors::class, 'pk'=>'tank_id' , 'sk'=>'value'] , 
                'spec_model'=>['model'=>\App\Models\Tanks\TanksSpecs::class, 'pk'=>'tank_id'] , 

            ],
            'coils'=>[
                'model'=>\App\Models\Coils\CoilSeries::class , 
            ],
            'cartridges'=>[
                'model'=>\App\Models\Cartidges\Cartidge::class ,
            ],

        ];
        return $attributes[$itemType];
    }
    public function save(){
        try{
            DB::transaction(function(){
                $item = $this->createMainItem();
                $this->modelItem = $item ; 
                $this->addImages();
                if(in_array($this->itemType , ['devices','tanks'])){
                    $this->addColors();
                    $this->addSpecs();
                }
                if($this->itemType === 'devices'){
                    $this->addDevicesSpecialFields();
                }
                if($this->itemType === 'coils'){
                    $this->addCoilsSpecialFields();
                }
                if($this->itemType === 'cartridges'){
                    $this->addCartridgesSpecialFields();
                }
                $this->dispatch('cancelForm');
            });
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
    public function addCoilsSpecialFields(){
        foreach($this->coilVariants as $v){
            Coils::create(['name'=>$v['name'],
            'resistance'=>$v['resistance'],
            'wattage_range'=>$v['wattage_range'],
            'vaping_style'=>$v['vaping_style'],
            'description'=>$v['description'],
            'coil_series_id'=>$this->modelItem->id 
            ]);
        }
    }
    public function addCartridgesSpecialFields(){
        foreach($this->cartidgeVariants as $v){
            CartidgeVariants::create([
            'resistance'=>$v['resistance'],
            'vaping_style'=>$v['vaping_style'],
            'cartridge_id'=>$this->modelItem->id 
            ]);
        }
    }
    public function addDevicesSpecialFields(){
        foreach($this->featureFields as $feature){
            DeviceFeatures::create(['device_id'=>$this->modelItem->id , 'name'=>$feature]);
        }
        
        foreach($this->flavorFields as $flavor_id){
            DeviceFlavors::create(['device_id'=>$this->modelItem->id , 'component_id'=>$flavor_id]);
        }
           
        if($this->category_id == 2 ) 
        {
            DevicePuffs::create(['device_id'=>$this->modelItem->id , 'value'=>$this->device_puffs , 
            'nicotine_strength'=> $this->device_puffs_nicotine_type,
            'nicotine_type'=>$this->device_puffs_nicotine_strength , 
            'ice_type'=>$this->device_puffs_ice_type]);
        }
        
        
    }

    public function addColors(){
        $color = $this->getItemsAttributes($this->itemType)['color_model'];
        $colorModel = $color['model'];
        $pk = $color['pk'];
        $sk = $color['sk'];
        foreach($this->colorFields as $cf){
            $colorModel::create([$pk=>$this->modelItem->id , $sk=>$cf]);
        }
    }

    public function addSpecs(){
        $spec = $this->getItemsAttributes($this->itemType)['spec_model'];
        $sepcModel = $spec['model'];
        $pk = $spec['pk'];
        foreach($this->specFields as $sf){
            $sepcModel::create([$pk=>$this->modelItem->id ,'spec_key'=>$sf['key'] , 'spec_value'=>$sf['value']]);
        }
    }

    public function createMainItem(){
        $modelName = $this->getItemsAttributes($this->itemType)['model'];
        if($this->itemType == 'devices'){
            $data = [
            'name'=>$this->name , 'release_year'=>$this->release_year , 'sku'=>$this->sku , 
            'brand_id'=>$this->brand->id , 'category_id'=>$this->category_id
            ];
        
        }elseif($this->itemType === 'tanks'){
            $data = [
                'name'=>$this->name ,
                'category_id'=>$this->category_id , 'brand_id'=>$this->brand->id,
                'type'=>strtolower($this->type) , 
                'vaping_style'=>strtolower($this->vaping_style) , 
                'release_year'=>$this->release_year
            ];
        }elseif($this->itemType === 'coils'){
            $data = [
                'name'=>$this->name , 
                'category_id'=>$this->category_id , 
                'brand_id'=>$this->brand->id , 
                'description'=>$this->description
            ];
        }elseif($this->itemType === 'cartridges'){
            $data = [
                'name'=>$this->name,
                'type'=>$this->type,
                'capacity_ml'=>$this->capacity_ml
                ,'description'=>$this->description
                ,'brand_id'=>$this->brand->id
                ,'category_id'=>$this->category_id
                ,'material'=>$this->material
                ,'coil_type'=>$this->coil_type
                ,'has_resistance'=>$this->has_resistance ?? true
            ]; 
        }
        return $modelName::create($data);
    }

    public function initializeCreateFields($itemType , $category_id){
        $this->itemType = $itemType ;
        $this->category_id = $category_id ; 
        $this->images = []; // COMMON [DEVICES , TANKS , COILS , CARTRIDGES];
        
        if(in_array($itemType , ['tanks','devices'])){
            $this->colorFields = ['']; // DEVICES , TANKS ; 
            $this->specFields = [['key' => '', 'value' => '']];
        }

        // Initialize additional fields based on item type
        if ($itemType === 'devices') {
            $this->featureFields = [''];
            $this->flavorFields = [''];
        }
        if($itemType === 'coils'){
            $this->coilVariants[] = [
                'name'=>'',
                'resistance'=>'',
                'wattage_range'=>'',
                'vaping_style'=>'',
                'description'=>'',
            ];
        }

    }
   

    private function addImages(){
         $this->uploadImage(
            source: $this->images,
            input_name: 'images',
            foldername: $this->itemType , 
            disk: 'public',
            imageable_id: $this->modelItem->id ,
            imageable_type: get_class($this->modelItem),
        );
    }

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
    
    public function addCoilVairants(){
        $this->coilVariants[] = 
            [
                'name'=>'',
                'resistance'=>'',
                'wattage_range'=>'',
                'vaping_style'=>'',
                'description'=>'',
            ];
    }
    public function removeCoilVairants($index){
        if(count($this->coilVariants)>0){
            unset($this->coilVariants[$index]);
            $this->coilVariants = array_values($this->coilVariants);
        }
    }

    public function addCartridgeVairants(){
        $this->cartidgeVariants[] = 
            [
                'resistance'=>'',
                'vaping_style'=>'',
            ];
    }
    public function removeCartridgeVairants($index){
        if(count($this->cartidgeVariants)>0){
            unset($this->cartidgeVariants[$index]);
            $this->cartidgeVariants = array_values($this->cartidgeVariants);
        }
    }

    public function addSpecField()
    {
        $this->specFields[] = ['key' => '', 'value' => ''];
    }

    public function removeSpecField($index)
    {
        if (count($this->specFields) > 1) {
            unset($this->specFields[$index]);
            $this->specFields = array_values($this->specFields);
        }
    }

    public function removeImage($id){
        unset($this->images[$id]);
    }
    public function cancelForm()
    {
        $this->dispatch('cancelForm');        
    }

}