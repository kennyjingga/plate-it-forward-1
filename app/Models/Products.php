<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'restaurant_id',
        'name',
        'price',
        'description',
        'foto',
    ];
    public function productExps()
    {
        return $this->hasMany(ProductExp::class, 'product_id');
    }
}
