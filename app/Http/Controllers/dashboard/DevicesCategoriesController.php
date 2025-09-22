<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\CommonModels\Component;
use App\Models\Hardware\DeviceColors;
use App\Models\Hardware\DeviceFeatures;
use App\Models\Hardware\DeviceFlavors;
use App\Models\Hardware\DeviceInventories;
use App\Models\Hardware\DevicePuffs;
use App\Models\Hardware\Devices;
use App\Models\Hardware\DevicesCategories;
use App\Models\Hardware\DevicesSpecs;
use Illuminate\Http\Request;

class DevicesCategoriesController extends Controller
{
    
    public function index(string $categorySlug){
        
        $category = DevicesCategories::bySlug($categorySlug)->firstOrFail();
        $deviceBrands = $category->brands()
        ->withCount(['devices as devices_count' => function ($q) use ($category) {
            $q->where('category_id', $category->id);
        }])
        ->get(['device_brands.id', 'device_brands.name' , 'device_brands.website' ,'device_brands.description','device_brands.country']);
        return view('dashboard.deviceCategories.index',compact('deviceBrands','categorySlug'));
    }

    public function show_devices_categories(string $categorySlug = null , int $brand_id , int $device_id = null ){
        $query = Devices::with(['colors','features','flavors','speces','inventories','puffs']) ;
        if (!$device_id){
            $devices = $query->where(['brand_id'=>$brand_id])->get();
            $flavors = Component::get(['id','name']);
            return view('dashboard.deviceCategories.device-categories-details',compact('devices','categorySlug','flavors'));
        }else{
            $device = $query->where(['id'=>$device_id , 'brand_id'=>$brand_id])->first();
            return view('dashboard.deviceCategories.device-details',compact('device'));
        }
    }

    public function store_device(Request $request){
        $device = Devices::create(['name'=>$request->name , 'release_year'=>$request->release_year , 'brand_id'=>$request->brand_id , 'category_id'=>$request->category_id]);
        // Decode the JSON strings back to arrays
        $colors = json_decode($request->colors_array ?? '[]', true);
        $flavors = json_decode($request->flavor_ids ?? '[]', true);
        $features = json_decode($request->features_array ?? '[]', true);
        $specs = json_decode($request->specifications ?? '[]', true);
        foreach($features as $feature){
            DeviceFeatures::create(['device_id'=>$device->id , 'name'=>$feature]);
        }
        foreach($colors as $color){
            DeviceColors::create(['device_id'=>$device->id , 'name'=>$color]);
        }
        foreach($flavors as $flavor_id){
            DeviceFlavors::create(['device_id'=>$device->id , 'component_id'=>$flavor_id]);
        }
        foreach($specs as $spec_key => $spec_value){
            DevicesSpecs::create(['device_id'=>$device->id , 'spec_key'=>$spec_key , 'spec_value'=>$spec_value]);
        }
        $puffs = $request->device_puffs ?? null ; 
        if($puffs){
            DevicePuffs::create(['device_id'=>$device->id , 'value'=>$puffs , 
            'nicotine_strength'=> $request->device_puffs_nicotine_type,
            'nicotine_type'=>$request->device_puffs_nicotine_strength , 
            'ice_type'=>$request->device_puffs_ice_type]);
        }
        return response()->json(['success'=>true]);
    }


    public function addInventory(Request $request , int $device_id){
        foreach($request->inventories as $inventory){
            $device_flavor_id   = null ; 
            $device_color_id = null ; 
            if(isset($inventory['device_flavor_id'])){
                $device_flavor_id = DeviceFlavors::where('device_id',$device_id)
                ->where('component_id',$inventory['device_flavor_id'])->first('id');
            }elseif(isset($inventory['device_color_id'])){
                $device_color_id = DeviceColors::where('device_id',$device_id)->where('name',$inventory['device_color_id'])->first('id');
            }
            DeviceInventories::create(['device_id'=>$device_id , 
            'device_flavor_id'=>optional($device_flavor_id)->id ?? null , 
            'device_color_id'=>optional($device_color_id)->id??null, 
            'stock_quantity'=>$inventory['stock_quantity'] , 
            'base_price'=>$inventory['cost_price'], 
            'batch_number'=>$inventory['batch_number'] ?? null, 
            'displayed_at'=>now()]
            );
        }

        return redirect()->back();
    }
}
