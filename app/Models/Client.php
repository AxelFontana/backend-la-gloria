<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{


    protected $fillable = ['email'];
    public static $rules = [
        'email' => 'required|email|unique:clients,email',
    ];
    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
