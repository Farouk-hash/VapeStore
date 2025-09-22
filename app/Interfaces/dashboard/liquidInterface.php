<?php 
namespace App\Interfaces\Dashboard;

use Illuminate\Http\Request;
interface liquidInterface{
    public function index();
    public function show(int $liquid_id);
    public function create();
    public function store(Request $request);
    public function update(Request $request , int $liquid_id);
    public function destroy(int $liquid_id);
    public function addInventory(Request $request , int $brand_id);
}