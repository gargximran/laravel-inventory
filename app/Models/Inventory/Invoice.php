<?php

namespace App\Models\Inventory;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoice extends Model
{
    use SoftDeletes;
    protected $fillable = ['supplier_id', 'total_price_before_discount', 'price_after_discount', ];


    public function buy(){
        return $this->hasMany(Buy::class)->withTrashed();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }
    public function expense(){
        return $this->hasOne(Expense::class)->withTrashed();
    }

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    
        
    }
}
