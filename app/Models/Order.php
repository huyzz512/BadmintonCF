<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public $timestamps = false;
    protected $casts = [
        'created_at' => 'datetime',
    ];
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}