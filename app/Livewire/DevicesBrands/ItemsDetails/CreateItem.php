<?php

namespace App\Livewire\DevicesBrands\ItemsDetails;

use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceFeatures;
use App\Models\Hardware\DeviceFlavors;
use App\Models\Hardware\DevicePuffs;
use App\Models\Hardware\DevicesCategories;
use App\Traits\CreateItemsMethods;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;



class CreateItem extends Component
{
    use CreateItemsMethods;
    public $brand;
    public $featureFields = [] , $flavorFields = [] , $categories ;
    public $flavors , $category_id;
    public $device_puffs, $device_puffs_nicotine_strength,$device_puffs_nicotine_type , $device_puffs_ice_type ;

    public function mount($id , $slug)
    {   
        $this->brand = DeviceBrands::where('id',$id)->first();
        $this->flavors = \App\Models\CommonModels\Component::get();

        if(!isset($slug)){
            $this->categories = DevicesCategories::where('hardware',true)->get();
        }else{
            $this->category_id = DevicesCategories::where('slug',$slug)->value('id');
        }
        $this->initializeCreateFields('devices',$this->category_id);   
    }

    
    public function addFeatureField()
    {
        $this->featureFields[] = '';
    }

    public function removeFeatureField($index)
    {
        if (count($this->featureFields) > 1) {
            unset($this->featureFields[$index]);
            $this->featureFields = array_values($this->featureFields);
        }
    }

    public function addFlavorField()
    {
        $this->flavorFields[] = '';
    }

    public function removeFlavorField($index)
    {
        if (count($this->flavorFields) > 1) {
            unset($this->flavorFields[$index]);
            $this->flavorFields = array_values($this->flavorFields);
        }
    }


    public function render()
    {
        return view('livewire.devices-brands.items-details.create-item');
    }
}