<?php

namespace App\Models\Bills;

use App\Models\GroupInventories\GroupInventory;
use App\Models\Hardware\DeviceInventories;
use App\Models\Vape\LiquidInventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetails extends Model
{
    use HasFactory;
    protected $table='bills_details';
    public $fillable=['bill_id','device_inventory_id','liquid_inventory_id','group_inventory_id','quantity','unit_price','line_total','inventory_source'];
    
    public function bill(){
        return $this->belongsTo(Bills::class , 'bill_id');
    }
    public function device(){
        return $this->belongsTo(DeviceInventories::class,'device_inventory_id');
    }
    public function liquid(){
        return $this->belongsTo(LiquidInventory::class , 'liquid_inventory_id');
    }
    public function group(){
        return $this->belongsTo(GroupInventory::class , 'group_inventory_id');
    }
}
