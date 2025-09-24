<?php 
namespace App\Helpers;

use App\Models\Image\Image;
use Illuminate\Support\Facades\Auth;
use URL;

// FOR BLADES[User-profile , employees-profiles] ; 
class ImageHelper{
 
    public static function getUserImageUrl($user = null): ?string
    {
        // Use provided user or get current authenticated user
        if (!$user) {
            $user = Auth::user();
        }
        
        if (!$user) {
            return null;
        }

        // Get image model
        $imageModel = Image::where('imageable_id', $user->id)
            ->where('imageable_type', get_class($user))
            ->first();

        if (!$imageModel || !$imageModel->url) {
            return null;
        }

        // Determine guard type and build path
        $guardType = self::getUserGuardType($user);
        $imagePath = "storage/{$guardType}/{$imageModel->url}";
        
        return URL::asset($imagePath);
    }

 
    private static function getUserGuardType($user = null): string
    {
        if (!$user) {
            if (Auth::guard('admin')->check()) {
                return 'admin';
            }
            
            if (Auth::guard('sales')->check()) {
                return 'sales';
            }
        }
        
        // If user is provided, determine by class or other logic
        return Auth::guard('admin')->check() ? 'admin' : 'sales';
    }

    
    public static function getUserImageUrlWithFallback($user = null, string $fallback = 'assets/img/faces/6.jpg'): string
    {
        return self::getUserImageUrl($user) ?? URL::asset($fallback);
    }
}