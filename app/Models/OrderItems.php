<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'items_id', 'quantity', 'price', 'subtotal', 'custom_details'];

    public function product()
    {
        return $this->belongsTo(Item::class, 'items_id');
    }

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
    protected $casts = [
    'custom_details' => 'array',
    ];

    public function uploaded_images(){
        return $this->belongsTo(Upload_images::class, 'custom_image');
    }
}
