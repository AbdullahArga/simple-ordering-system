<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderDetail extends Pivot
{
    //
    protected $fillable = ['item_id', 'order_id', 'price', 'count'];
}
