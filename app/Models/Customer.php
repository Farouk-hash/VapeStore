<?php

namespace App\Models;

use App\Models\Bills\Bills;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory , HasApiTokens , Notifiable;
    protected $guard='customer';
    protected $fillable = ['name','email','password','phone'];
    protected $hidden = ['password','remember_token',];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed',];

    protected static function booted()
    {
        static::creating(function ($customer) {
            // If no password given, use phone as password
            if (empty($customer->password) && !empty($customer->phone)) {
                $customer->password = Hash::make($customer->phone);
            }
        });
    }
    
    public function bills(){
        return $this->hasMany(Bills::class , 'customer_id');
    }
    
    public function created_by(){
        return $this->morphTo();
    }

    // adding attribute ;
    public function getBillsDetailsAttribute(){
        return [
            'bills_count'=>$this->bills->count(),
            'total_price'=>number_format($this->bills->sum('total_price') , 2 , '.',',') , 
            'discount_value'=>number_format($this->bills->sum('discount_value') , 2 , '.',','), 
            'total_after_discount'=>number_format($this->bills->sum('total_after_discount'), 2 , '.',',') ,
            'total_discounts'=>$this->bills->where('has_discount',true)->count(),
            
            'total_items'=>collect($this->bills->flatMap(function($bill){
                return $bill->details;
            }))
        ];
    }
    public function getCreatedByDetailsAttribute(){
        return [
            'name'=>$this->created_by->name , 
            'id'=>$this->created_by->id ,
        ];
    }
}
