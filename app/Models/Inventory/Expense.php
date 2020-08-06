<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
