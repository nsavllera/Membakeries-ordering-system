<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'rating', 'comment', 'created_at'];


    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

}
