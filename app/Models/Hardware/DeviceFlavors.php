<?php

namespace App\Models\Hardware;

use App\Models\CommonModels\Component;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceFlavors extends Model
{
    use HasFactory;
    protected $table='device_flavors';
    public $fillable = ['component_id','device_id'];
    public function device(){
        return $this->belongsTo(Devices::class);
    }
    public function component(){
        return $this->belongsTo(Component::class,'component_id');
    }
    public function inventories()
    {
        return $this->hasMany(DeviceInventories::class, 'device_flavor_id');
    }
}
