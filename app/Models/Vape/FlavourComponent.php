<?php

namespace App\Models\Vape;

use App\Models\CommonModels\Component;
use Database\Factories\FlavourComponentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlavourComponent extends Model
{
    use HasFactory;
    protected $table = 'flavour_component';
    public $fillable = ['flavour_id', 'component_id'];
    public static function newFactory(){
        //return new FlavourComponentFactory();
    }
    public function flavors(){
        return $this->belongsToMany(Flavour::class,);
    }
    public function components(){
        return $this->belongsToMany(Component::class , );
    }
    
}
