<?php

namespace App\Models\Vape;

use Carbon\Carbon;
use Database\Factories\LiquidFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquid extends Model
{
    use HasFactory;
    protected $table = 'liquid';
    public $fillable = ['nicotine_type', 'vape_style', 'vg_pg_ratio', 'bottle_size_ml', 'flavour_id'];
    public static function newFactory(){
        // return new LiquidFactory();
    }
    // RELATIONS 
    public function flavour(){
        return $this->belongsTo(Flavour::class);
    }
    public function strengthNic(){
        return $this->hasMany(LiquidNicStrength::class , 'liquid_id' , 'id');
    }
    public function inventories()
    {
        return $this->hasManyThrough(
            LiquidInventory::class,
            LiquidNicStrength::class,
            'liquid_id',     // Foreign key on LiquidNicStrength
            'liquid_nic_strength_id', // Foreign key on LiquidInventory
            'id',            // Local key on Liquid
            'id'       // Local key on LiquidNicStrength
        );
    }
    // SCOPES ; 
     public function scopeByFlavour($query, $flavour_id)
    {
        return $query->where('flavour_id', $flavour_id);
    }

    public function scopeByNicotineType($query, $nicotine_type)
    {
        return $query->where('nicotine_type', $nicotine_type);
    }

    public function scopeByVapeStyle($query, $vape_style)
    {
        return $query->where('vape_style', $vape_style);
    }


     public function scopeByStrengthBetween($query, $min, $max)
    {
        return $query->whereHas('strengthNic', function ($q) use ($min, $max) {
            $q->whereBetween('strength', [$min, $max]);
        });
    }

    // ATTRIBUTES ;
    public function getFlavourInfoAttribute()
    {
        return $this->flavour 
            ? ['id' => $this->flavour->id, 'name' => $this->flavour->name] 
            : null;
    }

    public function getNicotineStrengthsAttribute()
    {
        return $this->strengthNic->pluck('strength')->toArray();
    }

    public function getDetailsAttribute()
    {
        return [
            'id'            => $this->id,
            'nicotine_type' => $this->nicotine_type,
            'vape_style'    => $this->vape_style,
            'vg_pg_ratio'   => $this->vg_pg_ratio,
            'bottle_size'   => $this->bottle_size_ml . ' ml',
            'flavour'       => $this->flavour 
                                ? ['id' => $this->flavour->id, 'name' => $this->flavour->name]
                                : null,
            'strengths'     => $this->strengthNic->map(function($strengthNic){
            return [
                'id'=>$strengthNic->id , 
                'strength'=>$strengthNic->strength ,
                'stocks'=>$strengthNic->inventories->map(function($stock){
                    return [
                        'id'=>$stock->id , 
                        'stock_received'=>$stock->stock_received , 
                        'received_at'=>$stock->received_at , 
                        'base_price'=>$stock->base_price
                    ];
                })->toArray()
            ];
            })->toArray(),

            'inventories'   => $this->inventories->map(function ($inventory) {
            return [
                'id'             => $inventory->id,
                'stock_received' => $inventory->stock_received,
                'received_at'    => $inventory->received_at,
                'base_price'     => $inventory->base_price,
                'strength_id'    => $inventory->liquid_nic_strength_id,
            ];
            })->toArray(),
        ];
    }
    protected function createdAt(): Attribute{
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }
    protected function updatedAt(): Attribute{
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }
    // HELPERS ; 
     public static function countByFlavour($flavour_id)
    {
        return static::byFlavour($flavour_id)->count();
    }

    public static function countByNicotineType($nicotine_type)
    {
        return static::byNicotineType($nicotine_type)->count();
    }

    public static function countByVapeStyle($vape_style)
    {
        return static::byVapeStyle($vape_style)->count();
    }

    public static function countByStrengthBetween($min, $max)
    {
        return static::byStrengthBetween($min, $max)->count();
    }

}
