<?php

namespace App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DamageProduct extends Model
{
    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function buy(){
        return $this->belongsTo(Buy::class, 'batch', 'id');
    }

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    
    }
}
