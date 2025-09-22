<?php

namespace App\Models\Vape;

use Database\Factories\LiquidNicStrengthFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidNicStrength extends Model
{
    use HasFactory;
    protected $table = 'liquid_nic_strength';
    public $fillable = ['liquid_id','strength'];
    public static function newFactory(){
        // return new LiquidNicStrengthFactory();
    }
    public function inventories()
    {
        return $this->hasMany(LiquidInventory::class, 'liquid_nic_strength_id');
    }
    public function liquid(){
        return $this->belongsTo(Liquid::class , 'liquid_id');
    }
}
