<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceColors extends Model
{
    use HasFactory;
    protected $table='device_colors';
    public $fillable=['device_id', 'name'];
    public function device(){
        return $this->belongsTo(Devices::class);
    }
     public function inventories()
    {
        return $this->hasMany(DeviceInventories::class, 'device_color_id');
    }
}
