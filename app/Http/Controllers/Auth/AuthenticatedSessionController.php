<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
   
    public function create(): View
    {
        return view('dashboard.auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
       $guard = $request->input('guard');
    
        $routeServiceProviderValue = $this->routeServiceProviderValue($guard);
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended($routeServiceProviderValue);         
    }
    protected function routeServiceProviderValue(string $guard){
        if($guard == 'admin'){
            return RouteServiceProvider::DASHBOARD_HOMEPAGE ;
        }elseif($guard == 'sales'){
            return RouteServiceProvider::DASHBOARD_HOMEPAGE;
        }else{
            abort(400,'INVALID GUARD');
        }
    }

    
    public function destroy(Request $request): RedirectResponse
    {
        
        $guard = $this->checkGuards()['value'];

        Auth::guard($guard)->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('register');
    }
    public function checkGuards(){
           
         
        if (Auth::guard('admin')->check()) {
            return ['value'=>'admin'];
        } elseif (Auth::guard('sales')->check()) {
            return ['value'=>'sales'];
        } else {
            abort(500); // not authenticated
        }
    }
}
