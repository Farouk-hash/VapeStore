<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceFeatures extends Model
{
    use HasFactory;
    protected $table='device_features';
    public $fillable = ['name','device_id'];
    public function device(){
        return $this->belongsTo(Devices::class);
    }
}
