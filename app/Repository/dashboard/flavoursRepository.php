<?php 

namespace App\Repository\Dashboard;

use App\Interfaces\Dashboard\flavoursInterface;

use App\Models\CommonModels\Brand;
use App\Models\CommonModels\Component;
use App\Models\Vape\Flavour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class flavoursRepository implements flavoursInterface {
    public function index(){
        $flavours = Flavour::withCount('components')->get();
        // FOR EDIT-MODAL ;
        $brands = Brand::get();
        $components = Component::get();
        return view('dashboard.flavours.index', compact('flavours','brands','components'));
    }
    
    public function create(){
        $components = Component::get(); // MANY TO MANY RELATION ; 
        $brands = Brand::get(); // MANY TO ONE RELATION ; 
        return view('dashboard.flavours.create', compact('brands' , 'components'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            foreach ($request->flavors as $index => $flavourData) {
                // Clean the data
                $flavourData['name'] = trim($flavourData['name']);
                $flavourData['brand_id'] = isset($flavourData['brand_id']) ? trim($flavourData['brand_id']) : null;
                $componentIds = $flavourData['component_ids'] ;

                // Create the brand
                $flavour = Flavour::create([
                    'name' => $flavourData['name'],
                    'brand_id' => $flavourData['brand_id'],
                ]);
                $flavour->components()->attach($componentIds);
            }
            // If everything was successful
            DB::commit();
            
            return redirect()->route('flavours.index');

        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()
                ->with('error', 'An error occurred while creating the flavours. Please try again.')
                ->withInput();
        }
    }

    public function update(Request $request , $flavour_id){
        // Find the component
        $flavour = Flavour::with(['brand', 'components'])->findOrFail($flavour_id);
        
        
        DB::beginTransaction();

        try { 
            // Update the component basic info
            $flavour->update([
                'name' => trim($request->name),
                'brand_id' => $request->brand_id,
            ]);

            // Handle flavors relationship
            $component_ids = $request->component_ids ?? [];
            // Sync flavors (this will add new ones, remove unselected ones, and keep existing ones)
            $flavour->components()->sync($component_ids);

            // Reload relationships to get updated data
            $flavour->load(['brand', 'components']);
        
            DB::commit();
            return redirect()->route('brands.show' , $request->brand_id)
                ->with('success', "Flavour '{$flavour->name}' updated successfully");

        } catch (Exception $e) {
            DB::rollback();
            
            dd($e);
            return redirect()->back()
                ->with('error', 'An error occurred while updating the flavour. Please try again.')
                ->withInput();
        }
        
    }
    public function destroy(int $flavour_id){
        $flavour = Flavour::findOrFail($flavour_id);
        $flavour->delete();
        return redirect()->route('flavours.index');
    }
}
