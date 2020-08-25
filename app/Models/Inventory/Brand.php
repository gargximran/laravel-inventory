<?php

namespace App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    use SoftDeletes;
    public function inventory(){
        return $this->hasMany(Inventory::class)->withTrashed();
    }

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    
    }
}
