<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Traits\HandlesMultiAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// TRAIT ; 
class ProfileController extends Controller
{
    use HandlesMultiAuth ; 

    public function index(){
        $authData = $this->getCurrentAuthenticationUser();
        $user = $authData['user'];
        $guard = $authData['guard'];
        $attributes = $this->buildUserAttributes($user , $guard); // [common , unqiue]-attributes ; 
        dd($attributes);
        // return view('dashboard.profile.profile',compact('attributes','guard'));
    }
   
    
}
