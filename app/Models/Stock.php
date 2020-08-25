<?php

namespace App\Models;

use App\Models\Inventory\Inventory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;
    public function inventory(){
        return $this->belongsTo(Inventory::class)->withTrashed();
    }


    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    
    }

    public function getexpireDateAttribute($value){
        if(!$value){
            return "Unlimited!";
        }
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    
    }
}
