<?php

namespace App\Models\Tanks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanksSpecs extends Model
{
    use HasFactory;
    protected $table = 'tanks_specs';
    public $fillable = ['tank_id','spec_key','spec_value'];
    public function tank(){
        return $this->belongsTo(Tanks::class , 'tank_id');
    }
}
