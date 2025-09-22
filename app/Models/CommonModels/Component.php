<?php

namespace App\Models\CommonModels;

use App\Models\Hardware\DeviceFlavors;
use App\Models\Vape\Flavour;
use App\Models\Vape\FlavourComponent;
use Carbon\Carbon;
use Database\Factories\ComponentFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $table = 'component';
    public $fillable = ['name','category_id'];
    public static function newFactory(){
        // return new ComponentFactory();
    }

    // RELATIONS ; 
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function flavours(){
        return $this->belongsToMany(
            Flavour::class,
            'flavour_component',
            'component_id',
            'flavour_id'
        );
    }
    public function deviceFlavors(){
        return $this->hasMany(DeviceFlavors::class,'component_id');
    }
    // SCOPES 
    public function scopeByCategory($query , $cateogry_id){
        return $query->where('category_id',$cateogry_id);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%{$keyword}%");
    }
    // Attributes 
    public function getCategoryAssoicatedAttribute()
    {
        return $this->category ? ['name'=>$this->category->name  , 'id'=>$this->category->id]: null;
    }
    protected function createdAt():Attribute{
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }
     protected function updatedAt():Attribute{
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }
    public function getFlavoursListAttribute()
    {
        return $this->flavours->map(fn($flavour) => [
            'id' => $flavour->id,
            'name' => $flavour->name
        ])->toArray();
    }
}
