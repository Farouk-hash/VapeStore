<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coils\Coils;
use App\Models\Coils\CoilSeries;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use Illuminate\Http\Request;

class CoilsController extends Controller
{
    public function index(){
        // $brandsIds = CoilSeries::distinct('brand_id')->pluck('brand_id')->toArray();
        $coilBrands = DeviceBrands::withCount('coils')->has('coils')->get();
        return view('dashboard.coils.index',compact('coilBrands'));
    }

    public function show($coil_brand_id){
        $coilSeries = CoilSeries::with(['coilsOhms','category','brand'])
        ->where('brand_id',$coil_brand_id)->get();
        $coilVapingStyles = CoilSeries::countByBrandAndStyle($coil_brand_id);
        return view('dashboard.coils.coils-brands-details',compact('coilSeries','coilVapingStyles' ));
    }
    public function store(Request $request){
        $coilSeries = CoilSeries::create([
        'name'=>$request->name  ,
        'description'=>$request->description,
        'brand_id'=>$request->brand_id , 
        'category_id'=>$request->category_id , 
        ]);
        
        $coils = json_decode($request->coils_data ?? '[]', true);

        foreach($coils as $coil){
            Coils::create([
            'coil_series_id'=>$coilSeries->id , 'resistance'=>$coil['resistance'] , 
            'vaping_style'=>$coil['vaping_style'],'wattage_range'=>$coil['wattage_range'] , 
            'name'=>$coil['name'],'description'=>$coil['name']]);
        }
        return response()->json(['success'=>true]);
    }
    public function addInventory(Request $request , int $coil_series_id){
        // dd($request->all());
        foreach($request->inventories as $inventory){
            DeviceInventories::create([
            'coil_series_id'=>$coil_series_id , 
            'coil_id'=>$inventory['device_color_id'], 
            'stock_quantity'=>$inventory['stock_quantity'] , 
            'base_price'=>$inventory['cost_price'], 
            'batch_number'=>$inventory['batch_number'] ?? null, 
            'displayed_at'=>now()]
            );
        }
        return redirect()->back();
    }
    
}
