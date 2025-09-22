<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    use HasFactory;
    protected $table = 'devices';
    public $fillable=['release_year','brand_id','category_id','name'];
    
    public function brand(){
        return $this->belongsTo(DeviceBrands::class);
    }
    public function puffs(){
        return $this->hasMany(DevicePuffs::class , 'device_id');
    }
    public function category(){
        return $this->belongsTo(DevicesCategories::class);
    }
    public function speces(){
        return $this->hasMany(DevicesSpecs::class,'device_id');
    }
    public function colors(){
        return $this->hasMany(DeviceColors::class,'device_id');
    }
    public function flavors(){
        return $this->hasMany(DeviceFlavors::class,'device_id');
    }
    public function features(){
        return $this->hasMany(DeviceFeatures::class,'device_id');
    }
    public function inventories()
    {
        return $this->hasMany(DeviceInventories::class,'device_id');
    }
}
