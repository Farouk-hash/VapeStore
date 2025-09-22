<?php

namespace App\Models\Vape;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidInventory extends Model
{
    use HasFactory;
    protected $table='liquid_inventory';
    public $fillable=['liquid_nic_strength_id','stock_received', 'received_at', 'displayed_at', 'is_active', 'batch_code', 'expiry_date', 'base_price', 'custom_price'];

    
    public function nicStrength()
    {
        return $this->belongsTo(LiquidNicStrength::class, 'liquid_nic_strength_id');
    }
    
    public static function details($liquid_id){
         
        $liquids = self::whereHas('nicStrength',function($q)use($liquid_id){
            $q->whereHas('liquid',function($q)use($liquid_id){
                $q->where('flavour_id',$liquid_id);
            });
        })->get();

        return 
        $liquids->map(function($liquid){
            return [
                'name'=>$liquid->nicStrength->strength . ' - ' .$liquid->nicStrength->liquid->nicotine_type. ' - ' . $liquid->nicStrength->liquid->vape_style . ' - ' .  $liquid->nicStrength->liquid->bottle_size_ml. 'ml' , 
                'quantities'=>$liquid->stock_received , 
                'base_price'=>$liquid->base_price , 
                'category'=>'liquids',
                'status'=>$liquid->is_active , 
                'id'=>$liquid->id ,
                'liquid_nic_strength_id'=>$liquid->liquid_nic_strength_id, 
                'foreignId'=>$liquid->liquid_nic_strength_id
            ];
        });
    }
}
