<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\brandsInterrface;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    protected $brandsInterrface ; 
    public function __construct(brandsInterrface $brandsInterrface){
        $this->brandsInterrface=$brandsInterrface ;
    }
    public function index(){
        return $this->brandsInterrface->index();
    }
    public function create(){
        return $this->brandsInterrface->create();
    }
    public function store(Request $request){
        return $this->brandsInterrface->store($request);
    }
    public function update(Request $request , int $brand_id){
        return $this->brandsInterrface->update($request , $brand_id);
    }
    public function destroy(int $brand_id){
        return $this->brandsInterrface->destroy($brand_id);
    }
    public function show(int $brand_id){
        return $this->brandsInterrface->show($brand_id);
    }
    public function add_strength(Request $request){
        return $this->brandsInterrface->add_strength($request);
    }
    public function delete_strength(int $liquid_strength_id){
        return $this->brandsInterrface->delete_strength($liquid_strength_id);
    }
    public function add_liquid(Request $request){
        return $this->brandsInterrface->add_liquid($request);
    }
    public function add_flavour(Request $request ,int $brand_id){
        return $this->brandsInterrface->add_flavour( $request ,$brand_id);
    }
}
