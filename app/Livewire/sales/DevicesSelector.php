<?php

namespace App\Livewire\sales;

use App\Models\Hardware\DeviceBrands;

use App\Models\Hardware\DeviceInventories;
use App\Models\Hardware\Devices;
use App\Models\Hardware\DevicesCategories;
use Livewire\Attributes\On;
use Livewire\Component;

class DevicesSelector extends Component
{
    public $devices = [] , $categories = [] , $brands = [] , $selectedDevices=[] , $quantities=[] ;
    public $selectedBrand , $selectedCategory , $selectedDevice ; 
    public function mount(){
        $this->initializeCategories();
        $this->initializeBrands();
    }

    public function onBrandChanged(){
        // GET CATEGORIES RELATED + DEVICES RELATED ; 
        $this->initializeCategories($this->selectedBrand);
        if($this->selectedCategory)$this->onDeviceChanged_Protected();
    }

    public function onCategoryChanged(){
        // GET BRANDS RELATED + DEVICES RELATED ; 
        $this->initializeBrands($this->selectedCategory);
        if($this->selectedBrand)$this->onDeviceChanged_Protected();
    }
    
    protected function initializeBrands(int $selectedCategory=null){
        if(!$selectedCategory){
            $this->brands = DeviceBrands::withCount('devices')->has('devices')->get();
            return ; 
        }
        $query=Devices::where('category_id',$selectedCategory);
        $this->devices = $query->get();
        $brandsIds = $query->distinct('brand_id')->pluck('brand_id')->toArray();
        $this->brands = DeviceBrands::whereIn('id',$brandsIds)->get();
        
    }

    protected function initializeCategories(int $selectedBrand=null){
        if(!$selectedBrand){
            $this->categories = DevicesCategories::all();
            return ; 
        }
        $query=Devices::where('brand_id',$this->selectedBrand);
        $this->devices = $query->get();
        $categoriesIds = $query->distinct('category_id')->pluck('category_id')->toArray();
        $this->categories = DevicesCategories::whereIn('id',$categoriesIds)->get();
        
    }

    protected function onDeviceChanged_Protected(){
        if($this->selectedBrand && $this->selectedCategory){
            $this->devices = Devices::where('brand_id',$this->selectedBrand)
            ->where('category_id',$this->selectedCategory)->get();
        }
        if(count($this->devices)==0) $this->devices=null;        
    }

    public function onResetCategories(){
        $this->reset(['selectedCategory','selectedBrand']);
        $this->initializeCategories();
        $this->initializeBrands();
    }
    public function onDeviceChanged(){
        $deviceInventories = DeviceInventories::where('device_id',$this->selectedDevice)->get();
        $this->selectedDevices = $deviceInventories ; 
        // CHAGE CATEGORY DROP-DOWN WHEN SELECTED ;
        if(count($deviceInventories)==='0'){
            $device = $deviceInventories->first()->device ; 
            $this->selectedCategory= $device->category_id;
            $this->selectedBrand= $device->brand_id;
        }
    }
    public function updatedQuantities($value , $key){
        $parts = explode('_', $key);
        $deviceInventoryId = $parts[1] ?? null;
        if ($deviceInventoryId) {
            // Get base price for this strength
            $basePrice = DeviceInventories::where('id', $deviceInventoryId)
                ->where('status', 'in_stock')
                ->value('base_price');
            
            // Convert existing quantities to collection if it's not already
            $existingQuantities = collect($this->quantities);
            
            // Update or add the new quantity data
            $this->quantities = $existingQuantities->put($deviceInventoryId, [
                'id'=>$deviceInventoryId ,
                'quantity'    => $value,
                'base_price'  => $basePrice,
                'total_price_per_item' => $basePrice * $value,
                'source' => 'devices' ,
            ])->toArray();
        }
        $this->dispatch('itemAdded', $this->quantities);
    }

    #[On('resetQuantities')]
    public function resetQuantities(){
        $this->reset('quantities','categories','devices','selectedDevices','selectedCategory');
        $this->initializeBrands();
    }
    public function render()
    {
        return view('livewire.sales.devices-selector');
    }
}
