<?php

namespace App\Livewire\DevicesBrands;

use App\Models\Cartidges\Cartidge;
use App\Models\Coils\CoilSeries;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DevicesCategories;
use App\Models\Tanks\Tanks;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BrandsShow extends Component
{
    public $slug , $deviceBrands , $selectedCategory , $categoryId, $slugCategories ; 

    public function mount(){
    //    $this->slugCategories = DevicesCategories::where('hardware',true)->get();
       $this->slugCategories = DevicesCategories::get();
       $this->initializeBrands(); // DEVICES [Pods , Kits , Disposables , ...]
    }

    public function updatedSelectedCategory($value){
        if(empty($value)){
            $this->reset('slug','categoryId');
            $this->initializeBrands();
            return ;
        } 
        [$this->slug , $this->categoryId] = explode('_',$value); // 1_PodSystem , 2_Disposable , ..... ; 
        
        $category = DevicesCategories::bySlug($this->slug)->firstOrFail();
                // dd($this->categoryId , $value);

        if(in_array($this->categoryId , [1,2,3,4,5] )){
            $query= $category->brands();
            $itemsCount = "devices";
        }

        elseif($this->categoryId == 6){
            $query = $category->tanksBrands();
             $itemsCount = "tanks";
        }elseif($this->categoryId == 7){
            $query = $category->coilsBrands();
             $itemsCount = "coils";
        }elseif($this->categoryId == 9){
            $query = $category->cartridgesBrands();
             $itemsCount = "cartridges";
        }
        
        $this->deviceBrands = $query->withCount(["$itemsCount as items_count" => function ($q) use ($category) {
            $q->where('category_id', $category->id);
        }])
        // ->toSql();
        ->get(['device_brands.id', 'device_brands.name' , 'device_brands.website' ,'device_brands.description','device_brands.country']);
        // dd($this->deviceBrands);
    }

    public function initializeBrands(){
        $this->deviceBrands = DeviceBrands::
        withCount(['devices','coils','tanks','cartridges'])->where('is_active',true)
        ->get();
        $this->deviceBrands = $this->deviceBrands->map(function ($d){
            $d->items_count = $d->devices_count + $d->coils_count + $d->tanks_count + $d->cartridges_count;
            return $d ; 
        });
    }

    public function editBrandForm($id){
        $this->dispatch('editBrandForm',$id);
    }

    public function changeActivation($id){
        DeviceBrands::where('id',$id)->update(['is_active'=>DB::raw('NOT is_active')]);
        $this->initializeBrands();
    }

    public function deleteBrand($id){
        DeviceBrands::where('id',$id)->delete();
        $this->initializeBrands();
    }

    public function showDetails($id){
        return redirect()->route('livewire.devices.itemsDetails',[$id , $this->slug]);
    }

    public function render()
    {
        return view('livewire.devices-brands.brands-show');
    }
}
