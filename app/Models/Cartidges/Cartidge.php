<?php

namespace App\Models\Cartidges;

use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use App\Models\Hardware\DevicesCategories;
use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartidge extends Model
{
    use HasFactory;
    protected $table='cartridge';
    public $fillable=['name','type','capacity_ml','description','brand_id','category_id','material','coil_type','has_resistance'];
    public function brand(){
        return $this->belongsTo(DeviceBrands::class , 'brand_id');
    }
    public function category(){
        return $this->belongsTo(DevicesCategories::class , 'category_id');
    }
    public function variants(){
        return $this->hasMany(CartidgeVariants::class , 'cartridge_id');
    } 
    public function inventories(){
        return $this->hasMany(DeviceInventories::class , 'cartridge_id');
    }
    public function images(){
        return $this->morphMany(Image::class , 'imageable');
    }
    public static function countByBrandAndStyle($brandId)
    {
        return self::select('type')
            ->selectRaw('COUNT(*) as total')
            ->where('brand_id', $brandId)
            ->groupBy('type')
            ->pluck('total', 'type');
    }
}
