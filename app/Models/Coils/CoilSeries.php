<?php

namespace App\Models\Coils;

use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceInventories;
use App\Models\Hardware\DevicesCategories;
use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoilSeries extends Model
{
    use HasFactory;
    protected $table='coil_series';
    public $fillable=['name','description','brand_id','category_id'];
    public function brand(){
        return $this->belongsTo(DeviceBrands::class , 'brand_id');
    }
    public function category(){
        return $this->belongsTo(DevicesCategories::class , 'category_id');
    }

    public function coilsOhms(){
        return $this->hasMany(Coils::class , 'coil_series_id');
    }

    public function inventories(){
        return $this->hasMany(DeviceInventories::class , 'coil_series_id');
    }
    public function images(){
        return $this->morphMany(Image::class , 'imageable');
    }
    public static function countByBrandAndStyle($brandId)
    {
        return Coils::select('vaping_style')
            ->join('coil_series', 'coils.coil_series_id', '=', 'coil_series.id')
            ->where('coil_series.brand_id', $brandId)
            ->groupBy('vaping_style')
            ->selectRaw('vaping_style, COUNT(*) as total')
            ->pluck('total', 'vaping_style');
    }

}
