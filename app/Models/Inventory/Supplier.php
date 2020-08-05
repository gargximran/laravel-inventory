<?php

namespace App\Models\Inventory;

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
}
