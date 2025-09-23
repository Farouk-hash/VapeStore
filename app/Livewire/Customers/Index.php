<?php

namespace App\Livewire\Customers;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $showCustomersProfile = false , $customerId;


    public function mount($forceDetailsID=null){
        if(isset($forceDetailsID)){
            $this->showCustomersProfile=true  ;
            $this->customerId = (int)$forceDetailsID ; 
        }
    }
    #[On('showCustomersProfile')]
    public function showCustomersProfile($id){
        $this->showCustomersProfile = true ; 
        $this->customerId = $id ; 
    }
    
    public function render()
    {
        return view('livewire.customers.index');
    }
}
