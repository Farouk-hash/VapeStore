<?php

namespace App\Models\Employee;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table='sales_attendance';
    public $fillable=['sales_id','date','check_in','check_out'];
    public function employee(){
        return $this->belongsTo(Sales::class , 'sales_id');
    }    
}
