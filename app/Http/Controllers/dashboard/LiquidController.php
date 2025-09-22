<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\flavoursInterface;
use App\Interfaces\Dashboard\liquidInterface;
use Illuminate\Http\Request;

class LiquidController extends Controller
{
    protected $liquidInterface ; 
    public function __construct(liquidInterface $liquidInterface){
        $this->liquidInterface=$liquidInterface ; 
    }
    public function index()
    {
        return $this->liquidInterface->index();
    }

    public function show(int $liquid_id){
        return $this->liquidInterface->show($liquid_id);
    }
    public function create()
    {
         return $this->liquidInterface->create();
    }
    public function store(Request $request){
        return $this->liquidInterface->store($request);
    }
    public function update(Request $request , int $liquid_id){
        return $this->liquidInterface->update($request , $liquid_id);
    }
    public function destroy(int $liquid_id){
        return $this->liquidInterface->destroy($liquid_id);
    }

    public function addInventory(Request $request , int $brand_id ){
        return $this->liquidInterface->addInventory($request , $brand_id);
    }
}
