<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class Details extends Component
{
    public $customer ;
    public function mount($customerId){
        $this->customer = Customer::where('id',$customerId)->with(['created_by','bills'])->first();
    }

    public function render()
    {
        return view('livewire.customers.details');
    }
}
