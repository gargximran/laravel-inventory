<?php

namespace App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    public function buy()
    {
        return $this->hasMany(Buy::class)->withTrashed();
    }

    public function invoice(){
        return $this->hasMany(Invoice::class)->withTrashed();
    }

    
    public function getCreatedAtAttribute($value){
            $date = Carbon::parse($value);
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
        
            
    }
}
