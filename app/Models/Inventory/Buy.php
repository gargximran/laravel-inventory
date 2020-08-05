<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    protected $fillable = ['inventory_id', 'supplier_id', 'quantity', 'per_price', 'total_price'];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
