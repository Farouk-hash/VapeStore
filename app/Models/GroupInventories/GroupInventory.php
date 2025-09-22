<?php

namespace App\Models\GroupInventories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupInventory extends Model
{
    use HasFactory;
    protected $table='group_inventories';
    protected $fillable=['name','price','valid'];
    public function details(){
        return $this->hasMany(GroupInventoryDetails::class , 'group_id') ; 
    }
    public function getTotalLiquidQuantityAttribute(){
          return $this->details->whereNotNull('liquid_id')->sum('quantity');  
    }
    public function getTotalDeviceQuantityAttribute(){
        return $this->details->whereNotNull('devices_id')->sum('quantity');
    }
}
