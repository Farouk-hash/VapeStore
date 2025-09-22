<?php

namespace App\Models\Hardware;

use App\Models\Cartidges\Cartidge;
use App\Models\Coils\CoilSeries;
use App\Models\Tanks\Tanks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceBrands extends Model
{
    use HasFactory;
    protected $table = 'device_brands';
    public $fillable = ['name','country','logo','description','website'];
    public function devices(){
        return $this->hasMany(Devices::class ,'brand_id');
    }
    public function coils(){
        return $this->hasMany(CoilSeries::class,'brand_id');
    }
    public function tanks(){
        return $this->hasMany(Tanks::class , 'brand_id');
    }
    public function cartridges(){
        return $this->hasMany(Cartidge::class , 'brand_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            // Case-insensitive comparison
            if (strcasecmp($brand->country, 'Egypt') !== 0) {
                $brand->premium = true;
            }
        });
    }
}
