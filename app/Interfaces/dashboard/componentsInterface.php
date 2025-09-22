<?php 
namespace App\Interfaces\Dashboard;

use Illuminate\Http\Request;
interface componentsInterface{
    public function index();
    public function create();
    public function store(Request $request);
    public function update(Request $request , int $component_id);
    public function destroy(int $component_id);
}