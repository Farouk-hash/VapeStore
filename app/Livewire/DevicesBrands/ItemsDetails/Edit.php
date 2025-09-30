<?php

namespace App\Livewire\DevicesBrands\ItemsDetails;

use App\Models\Hardware\Devices;
use App\Models\Hardware\DevicesCategories;
use App\Models\Image\Image;
use App\Traits\UpdateItemsMethods;
use App\Traits\UploadingImageTraits;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use UpdateItemsMethods;

    public $deviceId, $device, $brand, $categories;
    
    // Basic Information
    public $name, $release_year, $sku, $description, $category_id;
    
    // Category 2 Special Fields
    public $device_puffs, $device_puffs_nicotine_strength, $device_puffs_nicotine_type, $device_puffs_ice_type;
    
    // Dynamic Fields
    public $colorFields = [], $featureFields = [], $flavorFields = [], $specFields = [];
    
    // Images
    public $images = [], $existingImages = [];
    
    // Flavors List
    public $flavors;


    public function mount($id)
    {
        // dd($id);
        // $this->categories = DevicesCategories::all();
        $this->flavors = \App\Models\CommonModels\Component::all();
        
        $this->deviceId = $id;
        $this->loadDevice($id);        
    }

    public function loadDevice($deviceId)
    {
        $this->device = Devices::with(['colors', 'features', 'flavors', 'speces','images','category','brand'])
        ->where('id',$deviceId)->first();
        $this->brand = $this->device->brand;
        // dd($this->device->colors);
        // dd($this->device->name ,$this->device->release_year , $this->device->sku);
        $this->loadFields(type: 'devices' , model: $this->device); // TRAITS ;         
    }


    
    // Feature Methods
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

    // Flavor Methods
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



    // Validation Rules
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'release_year' => 'nullable|integer|min:2000|max:' . date('Y'),
            'sku' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            
            // Category 2 Fields
            'device_puffs' => 'nullable|integer|min:0',
            'device_puffs_nicotine_type' => 'nullable|string|max:255',
            'device_puffs_nicotine_strength' => 'nullable|string',
            'device_puffs_ice_type' => 'nullable|string|max:255',
            
            // Dynamic Fields
            'colorFields.*' => 'nullable|string|max:255',
            'featureFields.*' => 'nullable|string|max:255',
            'flavorFields.*' => 'nullable|exists:component,id',
            'specFields.*.key' => 'nullable|string|max:255',
            'specFields.*.value' => 'nullable|string|max:255',
            
            // Images
            'images.*' => 'nullable|image|max:2048',
        ];
    }

    // Update Device
    public function update()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                // Update Basic Information
                $this->device->update([
                    'name' => $this->name,
                    'release_year' => $this->release_year,
                    'sku' => $this->sku,
                    'description' => $this->description,                    
                ]);
                // Update Colors
                $this->updateColors();
                
                // Update Features
                $this->updateFeatures();
                
                // Update Flavors
                $this->updateFlavors();
                
                // Update Specifications
                $this->updateSpecifications();
                
                // DISPOSABLE ; 
                if($this->category_id == 2){
                    $this->updatePuffs();
                }
                // Upload New Images
                $this->uploadImages();


            });

            session()->flash('success', 'Device updated successfully');
            $this->dispatch('editFormCancelled'); 
        }
        catch (Exception $e) {
            dd($e->getMessage() , $this->specFields);
            session()->flash('error', 'Error updating device: ' . $e->getMessage());
        }
    }

    private function updatePuffs(){
        $this->device->puffs()->delete();
        $this->device->puffs()->create(['value'=> $this->device_puffs, 'nicotine_strength'=> $this->device_puffs_nicotine_strength  , 
        'nicotine_type'=> $this->device_puffs_nicotine_type, 'ice_type'=>$this->device_puffs_ice_type ]);
    }
    

    private function updateFeatures()
    {
        $this->device->features()->delete();
        foreach ($this->featureFields as $feature) {
            if (!empty(trim($feature))) {
                $this->device->features()->create(['name' => trim($feature)]);
            }
        }
    }

    private function updateFlavors()
    {
        $validFlavors = array_filter($this->flavorFields, function($flavor) {
            return !empty($flavor);
        });
        $this->device->flavors()->sync($validFlavors);
    }

    

    public function render()
    {
        return view('livewire.devices-brands.items-details.edit');
    }
}