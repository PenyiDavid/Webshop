<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'modell', 'color', 'size', 'stock', 'price', 'product_type_id'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function order(){
        //return $this->hasMany('App\Order');
        return $this->belongsToMany(Order::class);
    } 

}
