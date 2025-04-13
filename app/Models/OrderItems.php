<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'items_id', 'quantity', 'price', 'subtotal'];

    public function items()
    {
        return $this->belongsTo(Item::class);
    }

    public function orders()
    {
        return $this->belongsTo(Orders::class);
    }
}
