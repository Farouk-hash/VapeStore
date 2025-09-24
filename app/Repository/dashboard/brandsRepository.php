<?php 

namespace App\Repository\Dashboard;

use App\Interfaces\Dashboard\brandsInterrface;
use App\Models\CommonModels\Brand;
use App\Models\CommonModels\Component;
use App\Models\Vape\Flavour;
use App\Models\Vape\Liquid;
use App\Models\Vape\LiquidNicStrength;
use App\Traits\UploadingImageTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class BrandsRepository implements brandsInterrface {
    use UploadingImageTraits ; 
    public function index(){
        $brands = Brand::withCount('flavours')->get();
        return view('dashboard.brands.index',compact('brands'));
    }
    public function create(){
        return view('dashboard.brands.create');
    }
    public function store(Request $request){
        DB::beginTransaction();
        try {
            foreach ($request->brands as $index => $brandData) {
                // Clean the data
                $brandData['name'] = trim($brandData['name']);
                $brandData['country'] = isset($brandData['country']) ? trim($brandData['country']) : null;
                $brandData['description'] = isset($brandData['description']) ? trim($brandData['description']) : null;
                $brandData['is_active'] = isset($brandData['is_active']) && $brandData['is_active'] == 1;

                // Create the brand
                Brand::create([
                    'name' => $brandData['name'],
                    'country' => $brandData['country'],
                    'description' => $brandData['description'],
                    'is_active' => $brandData['is_active'],
                ]);
                
            }
            // If everything was successful
            DB::commit();
            
            return redirect()->route('brands.index');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'An error occurred while creating the brands. Please try again.')
                ->withInput();
        }
    }

    public function update(Request $request , int $brand_id){
        $brand = Brand::findOrFail($brand_id);
        DB::beginTransaction();
        try{
            $brand->update([
                'name' => trim($request->name),
                'country' => $request->country ? trim($request->country) : null,
                'description' => $request->description ? trim($request->description) : null,
                'is_active' =>  $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('brands.index')->with('success', "Brand '{$brand->name}' updated successfully!");
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()
            ->with('error', 'An error occurred while updating the brand. Please try again.')
            ->withInput();
        }

    }

    public function destroy(int $brand_id){
        $brand = Brand::findOrFail($brand_id);
        $brand->delete();
        return redirect()->route('brands.index');
    }

    public function show(int $brand_id){
        $brand = Brand::with('flavours.liquids')->findOrFail($brand_id);
        // FOR EDIT MODAL [ASSOICATED AT DASHBOARD.LIQUID.EDIT]; 
        $brands = Brand::all();
        $components = Component::all();
        // dd($brand->flavours[0]->liquids->pluck('nicotine_type')->unique());
        // dd($brand->flavours[0]->liquids);
        return view('dashboard.brands.brand-details', compact('brand','components','brands'));
    }

    public function add_strength(Request $request){
        LiquidNicStrength::create(['strength'=>$request->strength , 'liquid_id'=>$request->liquid_id]);
        return response()->json(['success' => true]);
    }
    public function delete_strength(int $liquid_strength_id){
        LiquidNicStrength::destroy($liquid_strength_id);
        return response()->json(['success'=>true]);
    }
    public function add_liquid(Request $request){
        Liquid::create([
        'flavour_id'=>$request->flavour_id , 
        'vape_style'=> $request->vape_style ,
        'nicotine_type'=> $request->nicotine_type ,
        'vg_pg_ratio'=> $request->vg_pg_ratio  ,
        'bottle_size_ml'=> $request->bottle_size_ml ,
        ]);
        return response()->json(['success' => true]);

    }

    public function add_flavour(Request $request , int $brand_id){
       DB::beginTransaction();
       try{

        // strengths: selectedStrengths,
            
            $flavor = Flavour::where('brand_id',$brand_id)->where('name',$request->name)->first();
            if(!$flavor){
                $flavor = Flavour::create(['brand_id'=>$brand_id , 'name'=>$request->name]  );
            }
           Log::info('created');
           $liquid = Liquid::create([
           'flavour_id'=>$flavor->id , 
           'nicotine_type'=>json_decode($request->nicotine_types , true)[0] , 
           'vape_style'=>json_decode($request->vape_styles , true)[0] ,
           'vg_pg_ratio'=>$request->vg_pg_ratio , 
           'bottle_size_ml'=>$request->bottle_size_ml,
           ]);
           $selectedStrengths = json_decode($request->strengths , true) ?? [] ;
           foreach($selectedStrengths as $s){
               LiquidNicStrength::create(['liquid_id'=>$liquid->id , 'strength'=>$s]);
           } 
        //    $images = $request->images ?? [];
           $this->uploadImage(
                source: $request->images,
                input_name: 'images',
                foldername: 'liquids' , 
                disk: 'public',
                imageable_id: $liquid->id,
                imageable_type: get_class($liquid),
                request_input_variable: 'name'
            );
           DB::commit();
           return response()->json(['success' => true]);
       }catch(Exception $e){
            DB::rollBack();
            Log::info("Error Occured While Inserting Liquids Via Brands:{$e->getMessage()}");
       }
    }
    
}