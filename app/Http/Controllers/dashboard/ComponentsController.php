<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\componentsInterface;
use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    protected $componentInterface ; 
    public function __construct(componentsInterface $componentInterface){
        $this->componentInterface = $componentInterface ;
    }
    public function index(){
        return $this->componentInterface->index();
    }
    public function create(){
        return $this->componentInterface->create();
    }
    public function store(Request $request){
        return $this->componentInterface->store($request);
    }
    public function update(Request $request , int $brand_id){
        return $this->componentInterface->update($request , $brand_id);
    }
    public function destroy(int $brand_id){
        return $this->componentInterface->destroy($brand_id);
    }
}
