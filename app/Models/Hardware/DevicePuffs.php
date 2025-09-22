<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicePuffs extends Model
{
    use HasFactory;
    protected $table='device_puffs';
    public $fillable=['device_id','value','nicotine_strength' , 'nicotine_type','ice_type'];
    public function device(){
        return $this->belongsTo(Devices::class );
    }
}
