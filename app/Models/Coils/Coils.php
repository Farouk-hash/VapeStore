<?php

namespace App\Models\Coils;

use App\Models\Hardware\DeviceInventories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coils extends Model
{
    use HasFactory;
    protected $table='coils';
    public $fillable=['name','resistance' , 'wattage_range' , 'vaping_style' , 'description' , 'coil_series_id'];
   
    public function coil(){
        return $this->belongsTo(CoilSeries::class , 'coil_series_id');
    }
    // public function inventories(){
    //     return $this->hasMany(DeviceInventories::class ,'coil_id');
    // }

}
