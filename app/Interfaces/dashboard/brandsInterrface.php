<?php 
namespace App\Interfaces\Dashboard;

use Illuminate\Http\Request;

interface brandsInterrface{
    public function index();
    public function create();
    public function store(Request $request);
    public function update(Request $request , int $brand_id);
    public function destroy(int $brand_id);
    public function show(int $brand_id);
    public function add_strength(Request $request);
    public function delete_strength(int $liquid_strength_id);
    public function add_liquid(Request $request);
    public function add_flavour(Request $request ,int $brand_id);
}