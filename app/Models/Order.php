<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'firstName',
        'lastName',
        'email',
        'phone',
        'address',
        'total_price',
    ];

    public function orderItems(){
        return $this->hasMany(Orderitem::class);
    }
}
