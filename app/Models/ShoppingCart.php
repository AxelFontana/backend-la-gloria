<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_carts';

    protected $fillable = [
        'total_price',
        'date',
        'client_id',
    ];

    protected $dates = [
        'date',
    ];

    public static $rules = [
        'total_price' => 'required|integer|min:0',
        'date' => 'required|date',
        'client_id' => 'required|exists:clients,id',
        'order_details' => 'required|array|min:1',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function ordersDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
