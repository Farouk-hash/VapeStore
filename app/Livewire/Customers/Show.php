<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class Show extends Component
{
    public $customers = [] ;
    public function mount(){
        $this->customers = Customer::with(['bills','created_by'])->get();
    }
    public function showCustomersProfile($id){
        $this->dispatch('showCustomersProfile' , $id);
    }
    public function render()
    {
        return view('livewire.customers.show');
    }
}
