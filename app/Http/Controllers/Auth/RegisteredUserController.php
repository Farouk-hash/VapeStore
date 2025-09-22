<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Sales;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('dashboard.auth.register');
    }


    public function store(Request $request): RedirectResponse
    {
        $guard = $request->input('guard');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $modelClass = match($guard){
            'admin'=> Admin::class,
            'customer'=> Customer::class,
            'sales'=> Sales::class,
            default=>abort(400 , 'Invalid Guard'),
        };
        
       
        $user = $modelClass::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard($guard)->login($user);

        return redirect(RouteServiceProvider::DASHBOARD_HOMEPAGE);
    }
}
