<?php

namespace App\Livewire\Employee;

use Livewire\Attributes\On;
use Livewire\Component;

class Employee extends Component
{
    public $showCreateForm=false ,$showEmployeeProfile=false ;
    public $employeeId ; 
    
    public function mount(){

    }

    #[On('createEmploymentDone')]
    public function createEmploymentDone(){
        $this->toggleCreateOrBack();
    }

    #[On('showProfile')]
    public function showProfile(int $employeeId){
        $this->showEmployeeProfile=true ; 
        !$this->showCreateForm= true ; 
        $this->employeeId = $employeeId;
    }
    
    public function toggleCreateOrBack()
    {
        if ($this->showEmployeeProfile) {
            // If currently showing details → back to main list
            $this->showEmployeeProfile = false;
            $this->showCreateForm = false;
        } elseif ($this->showCreateForm) {
            // If currently in create form → back to main list
            $this->showCreateForm = false;
        } else {
            // Otherwise → go to create form
            $this->showCreateForm = true;
        }
    }

    public function render()
    {
        return view('livewire.employee.employee');
    }
}
