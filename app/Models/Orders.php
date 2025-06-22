<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total','delivery_id', 'payment_id', 'is_notified'];

    public function items()
    {
        return $this->hasMany(OrderItems::class,'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }


    public function getCustomDetailsAttribute()
    {
        $firstItem = $this->items->first();
        return $firstItem?->custom_details ?? null;
    }


    public function getIsCustomAttribute()
    {
        $details = $this->custom_details;
        return !empty($details);
    }

}
