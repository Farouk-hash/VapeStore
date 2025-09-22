<?php

namespace App\Models\Bills;

use App\Models\Customer;
use App\Models\Hardware\DeviceInventories;
use App\Models\Vape\LiquidInventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $table='bills';
    public $fillable=['total_price','has_discount','discount_value','total_after_discount','customer_id'];
    
    public function details(){
        return $this->hasMany(BillDetails::class , 'bill_id');
    }
    
    public function devices(){
        return $this->
        belongsToMany(DeviceInventories::class , 'bills_details','bill_id','device_inventory_id')
        ->withPivot('quantity', 'unit_price', 'line_total')
        ->withTimestamps();
    }
    public function liquids(){
        return $this->
        belongsToMany(LiquidInventory::class , 'bills_details','bill_id','liquid_inventory_id')
        ->withPivot('quantity', 'unit_price', 'line_total')
        ->withTimestamps();
    }
    public function customer(){
        return $this->belongsTo(Customer::class , 'customer_id');
    }

    public function created_by(){
        return $this->morphTo();
    }
    public function notes(){
        return $this->hasMany(BillsNotes::class, 'bill_id');
    }
}
