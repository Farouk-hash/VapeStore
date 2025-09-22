<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicesSpecs extends Model
{
    use HasFactory;
    protected $table = 'device_specs';
    public $fillable = ['device_id','spec_key','spec_value'];
    public function device(){
        return $this->belongsTo(Devices::class);
    }
}
