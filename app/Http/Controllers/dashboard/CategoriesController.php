<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\categoriesInterface;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
      protected $categoriesInterface ; 
    public function __construct(categoriesInterface $categoriesInterface){
        $this->categoriesInterface=$categoriesInterface ;
    }
    public function index(){
        return $this->categoriesInterface->index();
    }
    public function create(){
        return $this->categoriesInterface->create();
    }
    public function store(Request $request){
        return $this->categoriesInterface->store($request);
    }
    public function update(Request $request , int $brand_id){
        return $this->categoriesInterface->update($request , $brand_id);
    }
    public function destroy(int $brand_id){
        return $this->categoriesInterface->destroy($brand_id);
    }
}
