<?php

namespace App\Models\CommonModels;

use \Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='category';
    public $fillable = ['name','description'];
    public static function newFactory(){
        // return new CategoryFactory();
    }
    public function components(){
        return $this->hasMany(Component::class);
    }
    protected function createdAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('d-m-Y'));
    }
  
}
