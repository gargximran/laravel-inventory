<?php

namespace App\Models\Inventory;

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
}
