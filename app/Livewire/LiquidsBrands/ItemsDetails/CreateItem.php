<?php

namespace App\Livewire\LiquidsBrands\ItemsDetails;

use Livewire\Component;
use App\Models\CommonModels\Brand;
use App\Models\Vape\Flavour;
use App\Models\Vape\Liquid;
use App\Models\Vape\LiquidNicStrength;
use App\Traits\UploadingImageTraits;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class CreateItem extends Component
{
    use WithFileUploads, UploadingImageTraits;

    public $brand, $name, $description, $vappingStyles, $nicTypes; 
    public $selectedVapingStyles = '', $selectedNicTypes = '', $strs = [];
    public $liquidProperties = []; // Array to store multiple combinations
    public $vgPgRatio, $bottleSize, $customVg, $customPg, $showCustomVgPg = false; 
    public $strengthInput, $errorMessage, $images; 
    public $showFlavorFormVariable = false;

    public function mount($id){
        $this->vappingStyles = ['MTL', 'DL', 'SALTNic'];
        $this->nicTypes = ['FreeBase', 'Salt', 'DL'];
        $this->brand = Brand::where('id',$id)->first();
        
        // Initialize first empty property set
        $this->addNewPropertySet();
    }

     // Add new empty property set
    public function addNewPropertySet()
    {
        $this->liquidProperties[] = [
            'nicotine_type' => '',
            'vape_style' => '',
            'strengths' => []
        ];
    }

    // Add strength to specific property set
    public function addStrengthBtn($propertyIndex)
    {
        if (!empty($this->strengthInput) && $this->strengthInput <= 50) {
            if (!in_array($this->strengthInput, $this->liquidProperties[$propertyIndex]['strengths'])) {
                $this->liquidProperties[$propertyIndex]['strengths'][] = $this->strengthInput;
            }
        }
        $this->reset('strengthInput');
    }

    // Remove strength from specific property set
    public function removeStrength($propertyIndex, $strengthIndex)
    {
        if (isset($this->liquidProperties[$propertyIndex]['strengths'][$strengthIndex])) {
            unset($this->liquidProperties[$propertyIndex]['strengths'][$strengthIndex]);
            // Reindex array
            $this->liquidProperties[$propertyIndex]['strengths'] = array_values($this->liquidProperties[$propertyIndex]['strengths']);
        }
    }

    // Add new property combination
    public function addLiquidProperties($propertyIndex)
    {
        // Validate current set
        if (empty($this->liquidProperties[$propertyIndex]['nicotine_type']) || 
            empty($this->liquidProperties[$propertyIndex]['vape_style']) || 
            empty($this->liquidProperties[$propertyIndex]['strengths'])) {
            $this->errorMessage = 'يجب ملء جميع الحوامل وإضافة تراكيز على الأقل';
            return;
        }

        // Add new empty set for next combination
        $this->addNewPropertySet();
        $this->errorMessage = '';
    }

    // Remove property set
    public function removePropertySet($index)
    {
        if (isset($this->liquidProperties[$index])) {
            unset($this->liquidProperties[$index]);
            $this->liquidProperties = array_values($this->liquidProperties);
        }
        
        // Always keep at least one set
        if (empty($this->liquidProperties)) {
            $this->addNewPropertySet();
        }
    }

    public function saveFlavorBtn()
    {
        // Remove empty last set if exists
        $validProperties = array_filter($this->liquidProperties, function($property) {
            return !empty($property['nicotine_type']) && !empty($property['vape_style']) && !empty($property['strengths']);
        });

        if (empty($validProperties)) {
            $this->errorMessage = 'يجب إضافة خصائص سائل واحدة على الأقل';
            return;
        }
        // dd($validProperties);
        DB::beginTransaction();
       try{

        // strengths: selectedStrengths,
            
            $flavor = Flavour::createOrFirst(['brand_id'=>$this->brand->id ,'name'=>$this->name]);
            if($this->customVg && $this->customPg){
                $this->vgPgRatio = "$this->customVg/$this->customPg";
            }

            foreach($validProperties as $index => $props){
                $liquid = Liquid::create([
                'flavour_id'=>$flavor->id , 
                
                'nicotine_type'=>$props['nicotine_type']  , 
                'vape_style'=>$props['vape_style']  ,

                'vg_pg_ratio'=>$this->vgPgRatio , 
                'bottle_size_ml'=>$this->bottleSize,
                ]);
                
                $selectedStrengths = $props['strengths']  ;

                foreach($selectedStrengths as $index => $s){
                    LiquidNicStrength::create(['liquid_id'=>$liquid->id , 'strength'=>$s]);
                } 
            }
            
          

           $this->uploadImage(
                source: $this->images,
                input_name: 'images',
                foldername: 'flavors' , 
                disk: 'public',
                imageable_id: $flavor->id,
                imageable_type: get_class($flavor),
            );
           DB::commit();
           $this->dispatch('hideFlavorFormVariable');
       }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }
    public function cancelForm(){
        $this->dispatch('hideFlavorFormVariable');
    }
    public function render()
    {
        return view('livewire.liquids-brands.items-details.create-item');
    }
}
