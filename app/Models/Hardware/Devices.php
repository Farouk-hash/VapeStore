<?php

namespace App\Models\Hardware;

use App\Models\CommonModels\Component;
use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    use HasFactory;
    protected $table = 'devices';
    public $fillable=['release_year','brand_id','category_id','name','description'];
    
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
    // public function flavors(){
    //     return $this->hasMany(DeviceFlavors::class,'device_id');
    // }
    public function flavors()
    {
        return $this->belongsToMany(
            Component::class,   // related model
            'device_flavors', // pivot table name
            'device_id',            // foreign key on pivot
            'component_id'             // related key on pivot
        );  
    }

    public function features(){
        return $this->hasMany(DeviceFeatures::class,'device_id');
    }
    public function inventories()
    {
        return $this->hasMany(DeviceInventories::class,'device_id');
    }
    public function images(){
        return $this->morphMany(Image::class , 'imageable');
    }
}
