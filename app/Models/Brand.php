<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','enable'
    ];

    public static $rules = [
        'name' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛñÑ0-9\s ]{1,20}$/|unique:brands',
        'enable' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
