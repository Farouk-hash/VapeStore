<?php 

namespace App\Repository\Dashboard;

use App\Interfaces\Dashboard\categoriesInterface;
use App\Models\CommonModels\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoriesRepository implements categoriesInterface {

    public function index(){
        $categories = Category::withCount('components')->get();
        return view('dashboard.categories.index',compact('categories'));
    }
    public function create(){
        return view('dashboard.categories.create');
    }
    
    public function store(Request $request){
        DB::beginTransaction();
        try {
            foreach ($request->categories as $index => $categoryData) {
                // Clean the data
                $categoryData['name'] = trim($categoryData['name']);
                $categoryData['description'] = isset($categoryData['description']) ? trim($categoryData['description']) : null;
                $categoryData['is_active'] = isset($categoryData['is_active']) && $categoryData['is_active'] == 1;

                // Create the brand
                Category::create([
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'is_active' => $categoryData['is_active'],
                ]);
                
            }
            // If everything was successful
            DB::commit();
            
            return redirect()->route('categories.index');

        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()
                ->with('error', 'An error occurred while creating the brands. Please try again.')
                ->withInput();
        }
    }

    public function update(Request $request , int $category_id){
        $category = Category::findOrFail($category_id);
        DB::beginTransaction();
        try{
            $category->update([
                'name' => trim($request->name),
                'description' => $request->description ? trim($request->description) : null,
                'is_active' => (bool) $request->is_active,
            ]);
            DB::commit();
            return redirect()->route('categories.index')->with('success', "Brand '{$category->name}' updated successfully!");
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()
            ->with('error', 'An error occurred while updating the brand. Please try again.')
            ->withInput();
        }

    }

    public function destroy(int $category_id){
       $category = Category::findOrFail($category_id);
       $category->delete();
       return redirect()->route('categories.index');
    }
}