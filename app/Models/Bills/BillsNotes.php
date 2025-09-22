<?php

namespace App\Models\Bills;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillsNotes extends Model
{
    use HasFactory;
    protected $table='bills_notes';
    protected $fillable=['title','notes','priority','bill_id','admin_id','read'];
    public function bill(){
        return $this->belongsTo(Bills::class , 'bill_id');
    }
    public function created_by(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }
    
}
