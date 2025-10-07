<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreBrandsRequest;
use App\Http\Requests\Api\V1\UpdateBrandsRequest;
use App\Http\Resources\BrandsResource;
use App\Models\CommonModels\Brand;
use Exception;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    protected static $WITH_ATTRIBUTUES=['flavours'];

    public function index(Request $request)
    {

        $pageSize = $request->has('page_size') ? $request->page_size : 10 ;
        $brands = Brand::with(self::$WITH_ATTRIBUTUES)
        ->when($request->has('active'),function($q)use($request){
            $q->where('is_active',$request->active);
        })
        ->when($request->has('premium'),function($q)use($request){
            $q->where('premium' , $request->premium);
        })
        ->paginate($pageSize);
       
        return BrandsResource::collection($brands);
    }

  
    public function store(StoreBrandsRequest $request)
    {
        $brand = Brand::create($request->validated());
        $brand->load('flavours');
        return new BrandsResource($brand);
    }

   
    public function show(string $id)
    {
        try{
            $brand = Brand::with(self::$WITH_ATTRIBUTUES)->findOrFail($id);
            return new BrandsResource($brand);
        }catch(Exception $e){
            return response()->json(['message'=>'Brand not found'],404);
        }
    }

    public function update(UpdateBrandsRequest $request, string $id)
    {
        try{
            $brand = Brand::with(self::$WITH_ATTRIBUTUES)->findOrFail($id);
            $brand->update($request->validated());
            return new BrandsResource($brand);
        }catch(Exception $e){
            return response()->json(['message'=>$e->getMessage()],400);
        }
    }

 
    public function destroy(string $id)
    {
        try{
            $brand = Brand::findOrFail($id);
            $brand->delete();
            return response()->json(['message'=>'Brand deleted succeffully'],204);
        }catch(Exception $e){
            return response()->json(['message'=>'Invalid id'],404);
        }
    }
}
