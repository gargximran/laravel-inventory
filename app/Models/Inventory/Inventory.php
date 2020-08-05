<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $fillable = ['name','size','code','quantity','image'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
