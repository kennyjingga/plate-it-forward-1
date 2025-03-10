<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total'];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
    public static function getCurrentCart()
    {
        return self::firstOrCreate(
            ['user_id' => Auth::id()],
            ['total' => 0]
        );
    }
}
