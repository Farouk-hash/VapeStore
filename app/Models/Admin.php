<?php

namespace App\Models;

use App\Models\Bills\Bills;
use App\Models\Employee\Attendance;
use App\Models\Image\Image;
use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard='admin';
     protected $fillable = [
        'name',
        'email',
        'password',
    ];

 
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendPasswordResetNotification($token){
        return $this->notify(new CustomResetPassword($token , 'admin'));
    }
    
    // Employee had been created via admin ; 
    public function sales(){
        return $this->hasMany(Sales::class , 'admin_id');
    }

    // Customer had been created via admin ; 
    public function customers(){
        return $this->morphMany(Customer::class , 'created_by');
    }

    public function bills(){
        return $this->morphMany(Bills::class , 'created_by');
    }
    // Admin Attendances ;
    public function attendances()
    {
        return $this->morphMany(Attendance::class, 'attendable');
    }

    public function images(){
        return $this->morphMany(Image::class , 'imageable');
    }
}
