<?php

namespace App\Models\GroupInventories;

use App\Models\Hardware\DeviceInventories;
use App\Models\Vape\LiquidInventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupInventoryDetails extends Model
{
    use HasFactory;
    protected $table='group_inventories_details';
    protected $fillable=['group_id','devices_id','liquid_id' , 'quantity' , 'source'];

    public function group(){
        return $this->belongsTo(GroupInventory::class , 'group_id');
    }
    public function devicesInventory(){
        return $this->belongsTo(DeviceInventories::class , 'devices_id');
    }
    public function liquidsInventory(){
        return $this->belongsTo(LiquidInventory::class , 'liquid_id');
    }

    public function details($type){
        if($type==='liquids'){
            $liquidDetails = $this->liquidsInventory->nicStrength->liquid ;
            $liquidFlavor = $liquidDetails->flavour->name ; 
            $values = [
                'source'=>$this->source,                    
                'name'=>"$liquidFlavor:$liquidDetails->nicotine_type-$liquidDetails->vape_style-$liquidDetails->bottle_size_ml  ml", 
                'quantity'=>$this->quantity,
                'inventory_quantity'=> $this->liquidsInventory->stock_received
            ];
        }
        else{
            $devicesDetails = $this->devicesInventory->simpleDetails($this->source);
            $devieName = $devicesDetails['name'] ;
            $values = ['name'=>$devieName , 'quantity'=>$this->quantity,'source'=>$this->source ,
            'inventory_quantity'=>$devicesDetails['quantities'] ];
        }
        return $values;
    }

}
