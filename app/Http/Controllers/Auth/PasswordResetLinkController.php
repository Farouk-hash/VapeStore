<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Exception;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('dashboard.auth.forgot-password');
    }

    /**
     * Handle password reset link request with enhanced debugging
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $guard = $request->guard;
            
            Log::info("Password reset attempt started", [
                'guard' => $guard,
                'email' => $request->email,
                'ip' => $request->ip()
            ]);

            // Validate guard selection
            if (!$guard) {
                Log::warning("No guard selected in password reset");
                return back()->withErrors(['guard' => 'يرجى اختيار نوع المستخدم']);
            }
            
            // Check if guard configuration exists
            $this->validateGuardConfiguration($guard);

            $request->validate([
                'email' => ['required', 'email'],
                'guard' => ['required', 'string']
            ]);

            // Debug: Log the broker configuration
            $this->debugBrokerConfiguration($guard);

            // Get the password broker
            $broker = $this->getPasswordBroker($guard);
            
            if (!$broker) {
                Log::error("Password broker not found", ['guard' => $guard]);
                return back()->withErrors(['email' => 'خطأ في تكوين النظام']);
            }

            Log::info("Attempting to send reset link", [
                'guard' => $guard,
                'email' => $request->email,
                'broker_config' => Config::get("auth.passwords.{$guard}")
            ]);

            // Send reset link
            $status = $broker->sendResetLink($request->only('email'));

            Log::info("Password reset status received", [
                'status' => $status,
                'guard' => $guard,
                'email' => $request->email
            ]);

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with('status', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني');
            }

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => $this->getCustomErrorMessage($status)]);

        } catch (Exception $e) {
            Log::error("Password reset critical error", [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'guard' => $request->guard ?? 'unknown',
                'email' => $request->email ?? 'unknown'
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'حدث خطأ في النظام. يرجى المحاولة لاحقاً']);
        }
    }

    /**
     * Validate guard configuration exists
     */
    private function validateGuardConfiguration(string $guard): void
    {
        // Check if guard exists in guards configuration
        $guards = Config::get('auth.guards', []);
        if (!isset($guards[$guard])) {
            throw new Exception("Guard '{$guard}' not found in auth.guards configuration");
        }

        // Check if provider exists
        $guardConfig = $guards[$guard];
        $providerName = $guardConfig['provider'] ?? null;
        
        if (!$providerName) {
            throw new Exception("No provider specified for guard '{$guard}'");
        }

        $providers = Config::get('auth.providers', []);
        if (!isset($providers[$providerName])) {
            throw new Exception("Provider '{$providerName}' not found in auth.providers configuration");
        }

        // Check if password broker exists
        $passwords = Config::get('auth.passwords', []);
        if (!isset($passwords[$guard])) {
            throw new Exception("Password broker '{$guard}' not found in auth.passwords configuration");
        }

        // Check if the password broker's provider matches
        $passwordConfig = $passwords[$guard];
        $passwordProvider = $passwordConfig['provider'] ?? null;
        
        if ($passwordProvider !== $providerName) {
            Log::warning("Provider mismatch", [
                'guard' => $guard,
                'guard_provider' => $providerName,
                'password_provider' => $passwordProvider
            ]);
        }

        Log::info("Guard configuration validated successfully", [
            'guard' => $guard,
            'provider' => $providerName,
            'password_provider' => $passwordProvider
        ]);
    }

    /**
     * Debug broker configuration
     */
    private function debugBrokerConfiguration(string $guard): void
    {
        $authConfig = Config::get('auth');
        
        Log::info("Auth configuration debug", [
            'guard' => $guard,
            'guards' => array_keys($authConfig['guards'] ?? []),
            'providers' => array_keys($authConfig['providers'] ?? []),
            'passwords' => array_keys($authConfig['passwords'] ?? []),
            'specific_guard_config' => $authConfig['guards'][$guard] ?? null,
            'specific_password_config' => $authConfig['passwords'][$guard] ?? null,
        ]);
    }

    /**
     * Get password broker safely
     */
    private function getPasswordBroker(string $guard)
    {
        try {
            return Password::broker($guard);
        } catch (Exception $e) {
            Log::error("Failed to get password broker", [
                'guard' => $guard,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Get custom error messages
     */
    private function getCustomErrorMessage(string $status): string
    {
        return match($status) {
            Password::INVALID_USER => 'لا يمكن العثور على مستخدم بهذا البريد الإلكتروني',
            Password::INVALID_TOKEN => 'رمز إعادة التعيين غير صحيح',
            Password::RESET_THROTTLED => 'يرجى الانتظار قبل المحاولة مرة أخرى',
            default => "حدث خطأ أثناء إرسال رابط إعادة التعيين: {$status}"
        };
    }
}
