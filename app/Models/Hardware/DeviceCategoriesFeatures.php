<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceCategoriesFeatures extends Model
{
    use HasFactory;
    protected $table='device_categories_features';
    public $fillable=['category_id','feature_key','feature_value','description'];
    
    public function category(){
        return $this->belongsTo(DevicesCategories::class,'category_id');
    }
}
