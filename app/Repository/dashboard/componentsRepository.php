<?php 

namespace App\Repository\Dashboard;

use App\Interfaces\Dashboard\componentsInterface;
use App\Models\CommonModels\Category;
use App\Models\CommonModels\Component;
use App\Models\Vape\Flavour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class componentsRepository implements componentsInterface {
    public function index(){
        $components = Component::get();
        // FOR EDIT-MODAL ;
        $categories = Category::get();
        $flavors = Flavour::get();
        return view('dashboard.vape-components.index',compact('components','categories','flavors'));
    }
    
    public function create(){
        $categories = Category::get();
        $flavors = Flavour::get();
        return view('dashboard.vape-components.create', compact('categories' , 'flavors'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            foreach ($request->components as $index => $componentData) {
                // Clean the data
                $componentData['name'] = trim($componentData['name']);
                $componentData['category_id'] = isset($componentData['category_id']) ? trim($componentData['category_id']) : null;
                $flavorIds = $componentData['flavor_ids'] ?? [];

                // Create the brand
                $component = Component::create([
                    'name' => $componentData['name'],
                    'category_id' => $componentData['category_id'],
                ]);
                $component->flavours()->attach($flavorIds);

                
            }
            // If everything was successful
            DB::commit();
            
            return redirect()->route('components.index');

        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()
                ->with('error', 'An error occurred while creating the components. Please try again.')
                ->withInput();
        }
    }

    public function update(Request $request , $component_id){
        // Find the component
        $component = Component::with(['category', 'flavours'])->findOrFail($component_id);
        
        
        DB::beginTransaction();

        try { 
            // Update the component basic info
            $component->update([
                'name' => trim($request->name),
                'category_id' => $request->category_id,
            ]);

            // Handle flavors relationship
            $flavorIds = $request->flavor_ids ?? [];
            
            // Sync flavors (this will add new ones, remove unselected ones, and keep existing ones)
            $component->flavours()->sync($flavorIds);

            // Reload relationships to get updated data
            $component->load(['category', 'flavours']);
        
            DB::commit();
            return redirect()->route('components.index')
                ->with('success', "Component '{$component->name}' updated successfully");

        } catch (Exception $e) {
            DB::rollback();
            
            dd($e);
            return redirect()->back()
                ->with('error', 'An error occurred while updating the component. Please try again.')
                ->withInput();
        }
        
    }
    public function destroy(int $component_id){
        $component = Component::findOrFail($component_id);
        $component->delete();
        return redirect()->route('components.index');
    }
}
