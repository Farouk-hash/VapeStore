<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('dashboard.auth.reset-password', ['request' => $request]);
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'guard' => ['required','string'] ,
        ]);
        $guard = $request->guard ; 
        
        $status = Password::broker($guard)->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        // 'remember_token' => Str::random(60),
                    ])->save();

                    // event(new PasswordReset($user));
                }
        );

        
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'تم تغيير كلمة المرور بنجاح، يمكنك تسجيل الدخول الآن');
        }
        return back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
        }
}
