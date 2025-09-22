<?php

namespace App\Models\Employee;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table='sales_employment_history';
    public $fillable=['sales_id','company_name','website','position_title','start_date','end_date','notes'];
    public function employee(){
        return $this->belongsTo(Sales::class , 'sales_id');
    }
}
