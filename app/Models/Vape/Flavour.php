<?php

namespace App\Models\Vape;

use App\Models\CommonModels\Brand;
use App\Models\CommonModels\Component;
use App\Models\Image\Image;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Database\Factories\FlavourFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavour extends Model
{
    use HasFactory;
    protected $table='flavour';
    public $fillable = ['name','brand_id','is_active'];
    public static function newFactory(){
        // return new FlavourFactory();
    }

    // RELATIONS ; 
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function getBrandAssoicatedAttribute()
    {
        return $this->brand ? ['name'=>$this->brand->name  , 'id'=>$this->brand->id]: null;
    }
    public function components(){
        return $this->belongsToMany(
            Component::class,
            'flavour_component',   // pivot table name
            'flavour_id',          // foreign key on pivot
            'component_id'         // related key
        );
    }
    public function liquids(){
        return $this->hasMany(Liquid::class);
    }
    public function images(){
        return $this->morphMany(Image::class , 'imageable');
    }
    // SCOPES ; 
    public function scopeFlavourStatus($query , $status = true){
        return $query->where('is_active',$status);
    }
    public function scopeByBrand($query , $brand_id){
        return $query->where('brand_id',$brand_id);
    }
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%{$keyword}%");
    }

    // Attributes
    public function getBrandNameAttribute()
    {
        return $this->brand ? ['name'=>$this->brand->name  , 'id'=>$this->brand->id]: null;

    }
    protected function createdAt():Attribute{
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }
     protected function updatedAt():Attribute{
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }
    public function getFlavoursListAttribute()
    {
        return $this->components->map(fn($component) => [
            'id' => $component->id,
            'name' => $component->name
        ])->toArray();
    }
}
