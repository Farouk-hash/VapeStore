<?php 
namespace App\Interfaces\Dashboard;

use Illuminate\Http\Request;
interface flavoursInterface{
    public function index();
    public function create();
    public function store(Request $request);
    public function update(Request $request , int $flavour_id);
    public function destroy(int $flavour_id);
}