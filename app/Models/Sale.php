<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable=[
        "servant_id",
        "quantity",
        "total_price",
       "payment_type",
      "payment_status"
];
public function servant(){
    return $this->belongsTo(Servant::class);
}
public function menus(){
    return $this->belongsToMany(Menu::class);
}
public function tables(){
    return $this->belongsToMany(Table::class);
}

}
