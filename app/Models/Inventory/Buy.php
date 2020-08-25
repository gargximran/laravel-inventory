<?php

namespace App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Buy extends Model
{
    use SoftDeletes;
    protected $fillable = ['inventory_id', 'supplier_id', 'quantity', 'per_price', 'total_price'];

    public function supplier(){
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class)->withTrashed();
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class)->withTrashed();
    }

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    
    }


    public function getexpireDateAttribute($value){

        if(!$value){
            return "Unlimited";
        }else{

        
            $date = Carbon::parse($value);
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
        }
    
    }


    public function damages(){
        return $this->hasMany(DamageProduct::class, 'batch', 'id');
    }

    public function return(){
        return $this->hasMany(Buy::class, 'returnFrom', 'id')->withTrashed();
    }

    public function returnFrom(){
        return $this->belongsTo(Buy::class, 'returnFrom', 'id')->withTrashed();
    }
}
