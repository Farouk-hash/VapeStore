<?php 

namespace App\Repository\Dashboard;


use App\Interfaces\Dashboard\liquidInterface;

use App\Models\CommonModels\Brand;
use App\Models\Vape\Flavour;
use App\Models\Vape\Liquid;
use App\Models\Vape\LiquidInventory;
use App\Models\Vape\LiquidNicStrength;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class liquidRepository implements liquidInterface {
    public function index(){
        $liquids = Liquid::get();
        // FOR EDIT-MODAL ;
        $flavours = Flavour::get();
        // FOR ADD-ITEMS MODAL -> $liquids[4]->strengthNic ; 
        return view('dashboard.liquid.index', compact('liquids' , 'flavours'));
    }
    
    public function show(int $liquid_id){
        $liquid = Liquid::findOrFail($liquid_id);
        if($liquid)$liquid=$liquid->details;
        return view('dashboard.liquid.liquid-details' , compact('liquid'));
    }

    public function create(){
        $brands = Brand::get(); // MANY TO MANY RELATION ; 
        $flavours = Flavour::get();
        return view('dashboard.liquid.create', compact('brands' , 'flavours'));
    }

    public function store(Request $request){
       DB::beginTransaction();
        try {
            foreach ($request->liquids as $index => $liquidData) {
             
                $liquidData['name'] = trim($liquidData['name']);
                $liquidData['nicotine_type'] = trim($liquidData['nicotine_type']);
                $liquidData['bottle_size_ml'] = trim($liquidData['bottle_size_ml']);
                $liquidData['vape_style'] = trim($liquidData['vape_style']);
                $liquidData['vg_pg_ratio'] = trim($liquidData['vg_pg_ratio']);
                $liquidData['flavour_id'] = trim($liquidData['flavour_id']);

                $nicotine_strengths = $liquidData['nicotine_strengths'] ;
                // Create the Liquid
                $liquid = Liquid::create([
                    'name' => $liquidData['name'],
                    'nicotine_type' => $liquidData['nicotine_type'],
                    'bottle_size_ml'=>$liquidData['bottle_size_ml'],
                    'vape_style' => $liquidData['vape_style'],
                    'vg_pg_ratio' => $liquidData['vg_pg_ratio'],
                    'flavour_id' => $liquidData['flavour_id'],
                ]);
                
                foreach($nicotine_strengths as $index=>$strength){
                    LiquidNicStrength::create(['liquid_id'=>$liquid->id , 'strength'=>$strength]);
                }
                var_dump($index);
            }
            // If everything was successful
            DB::commit();
            
            return redirect()->route('liquid.index');

        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()
                ->with('error', 'An error occurred while creating the liquids. Please try again.')
                ->withInput();
        }
    }

    public function update(Request $request , $liquid_id){
        // Find the liquid
        $liquid = Liquid::with(['flavour', 'strengthNic'])->findOrFail($liquid_id);        
        DB::beginTransaction();
        try { 
            // Update the liquid basic info
            $liquid->update([
                'name' => trim($request->name),
                "nicotine_type" => $request->nicotine_type,
                "vape_style" => $request->vape_style,
                "vg_pg_ratio" => $request->vg_pg_ratio,
                "bottle_size_ml" => $request->bottle_size_ml,
                "flavour_id" => $request->flavour_id
            ]);

            // Handle flavors relationship
            $strengths = $request->nicotine_strengths ?? [];
            // First, delete old ones
            $liquid->strengthNic()->delete();
            dd($strengths , $request->all());
            // Then, insert new ones
            if (!empty($strengths)) {
                $liquid->strengthNic()->createMany(
                    collect($strengths)->map(fn($s) => ['strength' => $s])->toArray()
                );
                dd('here');
            }
          
            // Reload relationships to get updated data
            $liquid->load(['flavour', 'strengthNic']);
        
            DB::commit();
            return redirect()->route('liquid.index')
                ->with('success', "Liquid '{$liquid->name}' updated successfully");

        } catch (Exception $e) {
            DB::rollback();
            
            dd($e);
            return redirect()->back()
                ->with('error', 'An error occurred while updating the liquid. Please try again.')
                ->withInput();
        }
        
        
    }
    public function destroy(int $liquid_id){
        $liquid = Liquid::findOrFail($liquid_id);
        $liquid->delete();
        return redirect()->route('liquid.index');
    }

    public function addInventory(Request $request , int $brand_id = null){
        DB::beginTransaction();
        try{
            $inventories = $request->inventories ; 
            foreach($inventories as $index => $inventory){
                if($inventory['stock_quantity'] != 0 ){
                     LiquidInventory::create([
                    'stock_received'=>$inventory['stock_quantity'] , 
                    'received_at'=>now() , 
                    'displayed_at'=>now(),
                    'liquid_nic_strength_id'=>$inventory['strength_id'] , 
                    'base_price'=>$inventory['base_price'] , 
                    ]);
                }  
            }
            DB::commit();
            if($brand_id)return redirect()->route('brands.show' , [$brand_id]);
            return redirect()->route('brands.show');

        }
        catch(Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->back();
        }

    }
}
