<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cartidges\Cartidge;
use App\Models\Cartidges\CartidgeVariants;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use Illuminate\Http\Request;

class CartridgesController extends Controller
{
    public function index(){
        $brands = DeviceBrands::withCount(['cartridges'])->has('cartridges')->get();
        return view('dashboard.cartridges.index', compact('brands'));
    }
    public function show(int $cartridge_brand_id){

        $cartridges = Cartidge::with(['variants','inventories'])->where('brand_id',$cartridge_brand_id)->get();
        return view('dashboard.cartridges.cartriges-brands-details',compact('cartridges'));
    }
    public function store(Request $request){
        $has_resistance_value = $request->has('has_resistance') ?? false ;

        $cartridge = Cartidge::create(['name'=>$request->name ,
        'brand_id'=>$request->brand_id , 'category_id'=>$request->category_id , 
        'type'=>$request->type , 'capacity_ml'=>$request->capacity_ml
        ,'description'=>$request->description , 'material'=>$request->material , 'coil_type'=>$request->coil_type,
        'has_resistance'=>$has_resistance_value ]);

        if($has_resistance_value){
            // Decode the JSON strings back to arrays
            $variants = json_decode($request->coils_data ?? '[]', true);
            if(count($variants)==0){
                foreach($variants as $variant){
                    CartidgeVariants::create([
                        'cartridge_id'=>$cartridge->id , 
                        'resistance'=>$variant['resistance'],
                        'vaping_style'=>$variant['vaping_style']
                    ]);
                }
            }
        }else{
            CartidgeVariants::create([
                'cartridge_id'=>$cartridge->id , 
                'resistance'=>0.00,
            ]);
        }
        return response()->json(['success'=>true]);
    }
    public function addInventory(Request $request , int $cartridge_id){
        foreach($request->inventories as $inventory){
            
            DeviceInventories::create([
            'cartridge_id'=>$cartridge_id , 
            'cartridge_variant_id'=>$inventory['device_color_id'],
            'stock_quantity'=>$inventory['stock_quantity'] , 
            'base_price'=>$inventory['cost_price'], 
            'batch_number'=>$inventory['batch_number'] ?? null, 
            'displayed_at'=>now()]
            );
        }
        return redirect()->back();
    }
}

