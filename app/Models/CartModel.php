<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;

    protected $table = 'cart_models';

    public $fillable = [
        'order_id',
        'component_id',
        'amount',
        'customer_id',
        'total',
        'payment_type',
        'payment_number',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function component()
    {
        return $this->belongsTo(ProductComponentModel::class, 'component_id', 'id');
    }
}
