<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'total', 'event_at'];

    public function orderDetails()
    {
        return $this->belongsToMany(Item::class, 'order_detail', 'item_id', 'order_id')
            ->using(OrderDetail::class)
            ->withPivot('price', 'count');
    }
}
