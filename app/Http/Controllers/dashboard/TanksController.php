<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use App\Models\Tanks\Tanks;
use App\Models\Tanks\TanksColors;
use App\Models\Tanks\TanksSpecs;
use Illuminate\Http\Request;

class TanksController extends Controller
{
    public function index(){
        $tankBrands = DeviceBrands::withCount('tanks')->has('tanks')->get();
        return view('dashboard.tanks.index',compact('tankBrands'));
    }
    
    public function show(int $tank_brand_id){
        
        $tanks = Tanks::with(['colors','speces','category','brand'])->where('brand_id',$tank_brand_id)->get();
        $styleCounts = Tanks::countByBrandAndStyle($tank_brand_id);

        return view('dashboard.tanks.tanks-brands-details',compact('tanks' , 'styleCounts'));
    }

    public function store(Request $request){
        $tank = Tanks::create(['name'=>$request->name , 'release_year'=>$request->release_year ,
        'brand_id'=>$request->brand_id , 'category_id'=>$request->category_id , 'vaping_style'=>$request->tank_vape_styling
        ,'type'=>$request->tank_type]);
        
        // Decode the JSON strings back to arrays
        $colors = json_decode($request->colors_array ?? '[]', true);
        $specs = json_decode($request->specifications ?? '[]', true);
        
        foreach($colors as $color){
            TanksColors::create(['tank_id'=>$tank->id , 'value'=>$color]);
        }
        
        foreach($specs as $spec_key => $spec_value){
            TanksSpecs::create(['tank_id'=>$tank->id , 'spec_key'=>$spec_key , 'spec_value'=>$spec_value]);
        }
        
        return response()->json(['success'=>true]);
    }

    public function addInventory(Request $request , int $tank_id){
        foreach($request->inventories as $inventory){
            $tankColorId = TanksColors::where('tank_Id',$tank_id)
            ->where('value',$inventory['device_color_id'])
            ->first('id');
        
            DeviceInventories::create(['tank_id'=>$tank_id , 
            'tank_color_id'=>optional($tankColorId)->id??null, 
            'stock_quantity'=>$inventory['stock_quantity'] , 
            'base_price'=>$inventory['cost_price'], 
            'batch_number'=>$inventory['batch_number'] ?? null, 
            'displayed_at'=>now()]
            );
        }
        return redirect()->back();
    }
}
