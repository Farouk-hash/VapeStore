<?php

namespace App\Models\Cartidges;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartidgeVariants extends Model
{
    use HasFactory;
    protected $table='cartridge_variants';
    public $fillable=['cartridge_id','resistance','vaping_style'];
    public function cartidge(){
        return $this->belongsTo(Cartidge::class , 'cartridge_id');
    }
}
