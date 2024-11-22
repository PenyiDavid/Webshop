<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product_type extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class);
    }
}
