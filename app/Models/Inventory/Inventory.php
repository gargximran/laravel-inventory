<?php

namespace App\Models\Inventory;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $fillable = ['name','size','code','quantity','image'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function buy(){
        return $this->hasMany(Buy::class);
    }


    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    
    }



    public function stock(){
        return $this->hasMany(Stock::class);
    }

    public function damageProduct(){
        return $this->hasMany(DamageProduct::class);
    }
}
