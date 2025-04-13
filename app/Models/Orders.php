<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total','delivery_id', 'payment_id'];

    public function items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
