<?php

namespace App\Models\Hardware;

use App\Models\Cartidges\Cartidge;
use App\Models\Coils\CoilSeries;
use App\Models\Tanks\Tanks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicesCategories extends Model
{
    use HasFactory;
    protected $table='device_categories';
    public $fillable=['name','description' , 'slug'];
    public function devices(){
        return $this->hasMany(Devices::class,'category_id');
    }
    public function tanks(){
        return $this->hasMany(Tanks::class , 'category_id');
    }
    public function coils(){
        return $this->hasMany(CoilSeries::class , 'category_id');
    }
    public function features(){
        return $this->hasMany(DeviceCategoriesFeatures::class , 'category_id');
    }
    

    public function brands(){
        return $this->
        hasManyThrough(DeviceBrands::class , Devices::class , 'category_id','id','id','brand_id')->distinct();
    }
    public function tanksBrands(){
        return $this->
        hasManyThrough(DeviceBrands::class , Tanks::class , 'category_id' , 'id' , 'id' , 'brand_id')->distinct();
    }
    public function coilsBrands(){
        return $this->
        hasManyThrough(DeviceBrands::class , CoilSeries::class , 'category_id' , 'id' , 'id' , 'brand_id')->distinct();
    }
    public function cartridgesBrands()
    {
        return $this->
        hasManyThrough(DeviceBrands::class , Cartidge::class , 'category_id' , 'id' , 'id' , 'brand_id')->distinct();
    }
    
    public function  scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
 

    
}
