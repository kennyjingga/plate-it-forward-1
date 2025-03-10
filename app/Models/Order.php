<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'restaurant_id', 'orphanage_id', 'total', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
