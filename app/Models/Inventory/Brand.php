<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function inventory(){
        return $this->hasMany(Inventory::class);
    }
}
