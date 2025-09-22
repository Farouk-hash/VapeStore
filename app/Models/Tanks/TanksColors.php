<?php

namespace App\Models\Tanks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanksColors extends Model
{
    use HasFactory;
    protected $table='tanks_colors';
    public $fillable=['value','tank_id'];
    public function tanks(){
        return $this->belongsTo(Tanks::class , 'tank_id');
    }
}
