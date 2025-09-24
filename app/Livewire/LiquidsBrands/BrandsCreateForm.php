<?php

namespace App\Livewire\LiquidsBrands;

use App\Models\CommonModels\Brand;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BrandsCreateForm extends Component
{
    public $brands ; 
    protected $rules = [
        'brands.*.name' => 'required|string|max:255',
        'brands.*.description' => 'nullable|string|max:500',
        'brands.*.country' => 'nullable|string|max:255',
        'brands.*.is_active' => 'boolean',
    ];

    public function mount(){
        $this->initalizeBrandsArray();
    }
    public function initalizeBrandsArray(){
        $this->brands[]=[
            'name'=>'',
            'description'=>'',
            'country'=>'' , 
            'is_active'=>true ,
        ];
    }
    public function addBrandForm(){
        $this->initalizeBrandsArray();
    }
    public function removeBrand($id){
        unset($this->brands[$id]);
    }
    public function submit(){
        $this->validate();

        DB::beginTransaction();
        try{
            foreach($this->brands as $brand){
                Brand::create($brand);
            }
            DB::commit();
            $totalBrandsCreated = count($this->brands);
            session()->flash('success' , "تم اضافه $totalBrandsCreated شركات بنجاح");
            $this->dispatch('createdBrandCompleted');
        }catch(Exception $e){
            DB::rollBack();
            dd($e );
        }
      
    }
    public function render()
    {
        return view('livewire.liquids-brands.brands-create-form');
    }
}
