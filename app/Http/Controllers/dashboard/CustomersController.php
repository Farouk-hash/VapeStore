<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    
    public function index()
    {
        $customers = Customer::with(['created_by','bills'])->get();
        return view('dashboard.customers.index', compact('customers'));
    }

  
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }

 
    public function show(string $id)
    {
        $customer = Customer::with(['bills.details','created_by'])
        ->find($id,['id','name','email','phone','created_by_id','created_by_type']);

        // dd($customer->billsDetails , $customer , $customer->createdByDetails);
        /*
            customer-name , phone , email [Customer];
            total-bills , total-price , total-price-after-discount , discount-value [Bills];
            active-customer ;
        */
        return view('dashboard.customers.profile',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
