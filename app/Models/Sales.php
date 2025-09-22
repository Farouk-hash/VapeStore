<?php

namespace App\Models;

use App\Models\Bills\Bills;
use App\Models\Employee\Attendance;
use App\Models\Employee\History;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sales extends Authenticatable
{
    use HasFactory;
    protected $guard='sales';
    protected $fillable = ['name','email','password','admin_id','phone','nationalID','bioData','account_active'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }
    public function history(){
        return $this->hasMany(History::class , 'sales_id');
    }
    public function attendance(){
        return $this->hasMany(Attendance::class ,'sales_id');
    }
    public function bills(){
        return $this->morphMany(Bills::class , 'created_by');
    }
    public function customers(){
        return $this->morphMany(Customer::class,'created_by');
    }
}
