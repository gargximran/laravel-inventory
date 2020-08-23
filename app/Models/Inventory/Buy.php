<?php

namespace App\Models\Inventory;
use Carbon\Carbon;
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

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d | h:i:s A');
    
    }


    public function getexpireDateAttribute($value){

        if(!$value){
            return "Unlimited";
        }else{

        
            $date = Carbon::parse($value);
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d | h:i:s A');
        }
    
    }
}
