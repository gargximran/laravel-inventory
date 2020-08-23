<?php

namespace App\Models\Inventory;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['supplier_id', 'total_price_before_discount', 'price_after_discount', ];


    public function buy(){
        return $this->hasMany(Buy::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function expense(){
        return $this->hasOne(Expense::class);
    }

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d | h:i:s A');
    
        
    }
}
