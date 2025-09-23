<?php

namespace App\Livewire\Employee;

use App\Models\Admin;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EmployeeIndex extends Component
{
    public $salesPersons=[];
    
    public function mount(){
        $this->initializeEmployees();
    }
    
    private function initializeEmployees(){
        $this->salesPersons = Sales::with(['admin'])->get(); 
    }
    
    public function changeActivation($id){
        Sales::find($id)->update(['account_active'=>DB::raw('NOT account_active')]);
        $this->initializeEmployees();
    }

    public function showProfile($id){
        $this->dispatch('showProfile',$id);
        // dd($id);
    }
    public function render()
    {
        return view('livewire.employee.employee-index');
    }
}
