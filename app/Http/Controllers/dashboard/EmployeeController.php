<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Employee\Attendance;
use App\Models\Sales;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class EmployeeController extends Controller
{
   
    public function index()
    {
        $salesPersons = Sales::with(['admin'])->get(['id','name','email','nationalID','phone','admin_id','account_active']);
        return view('dashboard.employee.index',compact('salesPersons'));
    }

    
    public function create()
    {
        return view('dashboard.employee.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => ['required', 'string', 'max:255' ,'unique:sales,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sales,email'],
            'phone' => ['required', 'string', 'max:20'],
            'nationalID' => ['required', 'string', 'max:20', 'unique:sales,nationalID'],
            'password' => ['required', 'confirmed', Rules\password::defaults()],
        ]);

        // Create sales user
        $salesPerson = Sales::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'phone' => $request->phone,
            'nationalID' => $request->nationalID,
            'password' => Hash::make($request->password),
            'bioData' => $request->bioData ,
            'admin_id'=>Auth::id(),
        ]);
        $salesPerson->history()->createMany($request->employment_history ?? []);

        return redirect()->route('employee.index')->with('success','تم انشاء موظف جديد');
    }
    
    public function show(string $id)
    {
        $user = Sales::with(['bills.details'])->where('id',$id)->first();
        $billsWithDetails = collect($user->bills->map(function($bill){
            return [
                'bill'=>$bill , 
                'details'=>$bill->details , 
                'totalProducts'=>$bill->details->sum('quantity') , 
                // 'discount_number'=>$bill->where('has_discount',true)->count()
            ];
        }));
        $billStats = [
            'total_discount_value'      => $user->bills->sum('discount_value'),
            'discounted_bills_count'    => $user->bills->where('has_discount', true)->count(),
            'total_after_discount_sum'  => $user->bills->sum('total_after_discount'),
            'total_price_sum'            => $user->bills->sum('total_price'),
            'totalProductsQuantities'    => $billsWithDetails->sum('totalProducts')
        ];
        // dd($user->bills->where('has_discount',true)->count());
        /*Shows each of the last 4 weeks...
        Each week has 7 small equal bars:
            Green bar = attended that day,
            Grey bar = absent
        */
        $attendances = Attendance::where('sales_id', $id)
        ->where('date', '>=', now()->subYear()->startOfYear()->toDateString())
        ->get()
        ->groupBy(function ($item) {
            return Carbon::parse($item->date)->startOfWeek()->format('Y-m-d');
        });
        return view('dashboard.employee.profile',
        compact('user','attendances','billStats'));
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        $salesPerson = Sales::where('id',$id)->first();
        $salesPerson->update($request->only(['name','email','phone','bioData']));
        return redirect()->route('employee.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salesPerson = Sales::where('id',$id)->first();
        $salesPerson->update(['account_active'=>$salesPerson->account_active == 0 ? true : false]);
        return redirect()->back();
    }
}
