<?php

namespace App\Http\Controllers\Apis\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoredFlavorsRequest;
use App\Http\Requests\Api\V1\UpdatedFlavorsRequest;
use App\Http\Resources\FlavorsResource;
use App\Models\Vape\Flavour;
use Exception;
use Illuminate\Http\Request;

class FlavorsController extends Controller
{
    protected static $WITH_ATTRIBUTUES=['brand','components','liquids'];
    
    public function index(Request $request)
    {
        $page_size = $request->has('page_size') ? $request->page_size : 10 ;

        $flavors = Flavour::with(self::$WITH_ATTRIBUTUES)
        ->when($request->has('name'), function ($q) use ($request) {
        $q->where(function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->name}%")
            ->orWhereHas('brand', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->name}%");
            });
        });
        })
        ->when($request->has('active'),fn($q)=>$q->where('is_active',$request->active))
        ->when($request->has('brand_id'),fn($q)=>$q->where('brand_id',$request->brand_id))
        
        ->paginate($page_size);

        return FlavorsResource::collection($flavors) ;
    }

      public function store(StoredFlavorsRequest $request)
    {
        try{
            $flavor = Flavour::create($request->validated());
            
            if ($request->filled('components')) {
                $flavor->components()->sync($request->components);
            }
            
            $flavor->load(self::$WITH_ATTRIBUTUES);
            return new FlavorsResource($flavor);
        }catch(Exception $e){
            return response()->json(['message'=>"Invalid input data {$e->getMessage()}"] , 400);
        }
    }

  
    public function show(string $id)
    {
        try{
            $flavor = Flavour::with(self::$WITH_ATTRIBUTUES)->findOrFail($id);
            return new FlavorsResource($flavor);
        }catch(Exception $e){
            return response()->json(['message'=>'Invalid flavor-id'],404);
        }
    }

   
    public function update(UpdatedFlavorsRequest $request, string $id)
    {
        try{
            $flavor = Flavour::with(self::$WITH_ATTRIBUTUES)->findOrFail($id);
            $flavor->update($request->validated());
            if($request->has('components')){
                $flavor->components()->sync($request->components);
            }
            return new FlavorsResource($flavor);
        }catch(Exception $e){
            return response()->json(['message'=>'Invalid input data'],400);
        }
    }

    public function destroy(string $id)
    {
        try{
            $flavor = Flavour::findOrFail($id);
            return response()->json(['message'=>'Flavor deleted succeffully'],204);
        }catch(Exception $e){
            return response()->json(['message'=>'Invalid brand id'],404);
        }
    }
}
