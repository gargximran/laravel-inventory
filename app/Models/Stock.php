<?php

namespace App\Models;

use App\Models\Inventory\Inventory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Stock extends Model
{
    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }


    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d | h:i:s A');
    
    }

    public function getexpireDateAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d | h:i:s A');
    
    }
}
