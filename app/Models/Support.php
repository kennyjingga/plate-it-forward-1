<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $table = 'supports';
    protected $primaryKey = 'support_id';
    public $incrementing = false; // Karena bukan auto-increment integer
    protected $keyType = 'string'; // Karena support_id berbentuk string

    protected $fillable = ['support_id', 'name', 'email', 'information', 'handled'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($support) {
            $lastSupport = Support::orderBy('support_id', 'desc')->first();
            $lastNumber = $lastSupport ? intval(substr($lastSupport->support_id, 1)) : 0;
            $support->support_id = 'S' . str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        });
    }
}
