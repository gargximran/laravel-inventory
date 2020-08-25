<?php

namespace App\Models\Inventory;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Inventory extends Model
{

    use SoftDeletes; 
    protected $fillable = ['name','size','code','quantity','image'];

    public function brand(){
        return $this->belongsTo(Brand::class)->withTrashed();
    }

    public function buy(){
        return $this->hasMany(Buy::class)->withTrashed();
    }


    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    
    }



    public function stock(){
        return $this->hasMany(Stock::class)->withTrashed();
    }

    public function damageProduct(){
        return $this->hasMany(DamageProduct::class);
    }
}
