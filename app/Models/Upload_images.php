<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload_images extends Model
{
    use HasFactory;

    protected $fillable =['image_path','created_at', 'updated_at'];

    public function items()
    {
        return $this->hasMany(OrderItems::class,'custom_image');
    }
}
