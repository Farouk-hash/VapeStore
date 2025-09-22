<?php

namespace App\Models\Tanks;

use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use App\Models\Hardware\DevicesCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanks extends Model
{
    use HasFactory;
    protected $table='tanks';
    public $fillable=['brand_id' , 'category_id','name','type','vaping_style', 'release_year'];
    
    public function category(){
        return $this->belongsTo(DevicesCategories::class , 'category_id');
    }
    public function brand(){
        return $this->belongsTo(DeviceBrands::class , 'brand_id');
    }
    public function colors(){
        return $this->hasMany(TanksColors::class , 'tank_id');
    }
    public function speces(){
        return $this->hasMany(TanksSpecs::class,'tank_id');
    }
    public function inventories()
    {
        return $this->hasMany(DeviceInventories::class,'tank_id');
    }
    public static function countByBrandAndStyle($brandId)
    {
        return self::select('vaping_style')
            ->selectRaw('COUNT(*) as total')
            ->where('brand_id', $brandId)
            ->groupBy('vaping_style')
            ->pluck('total', 'vaping_style');
    }
}
