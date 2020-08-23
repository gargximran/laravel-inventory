<?php

namespace App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function buy()
    {
        return $this->hasMany(Buy::class);
    }

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }

    
    public function getCreatedAtAttribute($value){
            $date = Carbon::parse($value);
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d | h:i:s A');
        
            
    }
}
