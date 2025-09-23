<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table='image';
    protected $fillable=['url','imageable_id','imageable_type'];
    public function imageable(){
        return $this->morphTo();
    }
}
