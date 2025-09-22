<?php 
namespace App\Interfaces\Dashboard;

use Illuminate\Http\Request;

interface categoriesInterface{
    public function index();
    public function create();
    public function store(Request $request);
    public function update(Request $request , int $category_id);
    public function destroy(int $category_id);
}