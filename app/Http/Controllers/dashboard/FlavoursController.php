<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\flavoursInterface;
use Illuminate\Http\Request;

class FlavoursController extends Controller
{
    protected $flavoursInterface ; 
    public function __construct(flavoursInterface $flavoursInterface){
        $this->flavoursInterface=$flavoursInterface ; 
    }
    public function index()
    {
        return $this->flavoursInterface->index();
    }

   
    public function create()
    {
         return $this->flavoursInterface->create();
    }
    public function store(Request $request){
        return $this->flavoursInterface->store($request);
    }
    public function update(Request $request , int $brand_id){
        return $this->flavoursInterface->update($request , $brand_id);
    }
    public function destroy(int $brand_id){
        return $this->flavoursInterface->destroy($brand_id);
    }
}
