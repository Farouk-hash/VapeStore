<?php

namespace App\Models\CommonModels;

use App\Models\Vape\Flavour;
use Carbon\Carbon;
use Database\Factories\BrandFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brand';
    protected $fillable = ['name','country','description','is_active','logo'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            // Case-insensitive comparison
            if (strcasecmp($brand->country, 'Egypt') !== 0) {
                $brand->premium = true;
            }
        });
    }
    public static function newFactory(){
        // return new BrandFactory();
    }
    // RELATIONS ; 
    public function flavours(){
        return $this->hasMany(Flavour::class);
    }

    // eager load 
    public function flavoursWithLiquids(){
        return $this->hasMany(Flavour::class)->with('liquids');
    }

    // SCOPES ; 
    public function scopeBrandStatus($query , $value=true){
        return $query->where('is_active' , $value);
    }
    public function scopeFromCountry($query , $value){
        return $query->where('country',$value);
    }
    public function scopeByFlavourId($query, $flavourId)
    {
        return $query->whereHas('flavours', function ($q) use ($flavourId) {
            $q->where('id', $flavourId);
        });
    }


    
    // HELPERS ;
    public static function countByFlavourId($flavourId)
    {
        return static::byFlavourId($flavourId)->count();
    }
   

    // ACCESSORS
    protected function createdAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }

}
