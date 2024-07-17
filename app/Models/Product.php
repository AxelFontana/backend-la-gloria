<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{

    use HasFactory;

    protected $fillable = [
        'name', 'size', 'image', 'price','stock','brand_id', 'category_id','enable',
    ];

    public static $rules = [
        'name' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛñÑ0-9\s ]{1,30}$/|unique:products',
        'image' => 'required|string',
        'size' => 'required|regex:/^[a-zA-Z0-9]{1,20}$/',
        'price' => 'required|integer|min:0|max:9999',
        'stock' => 'required|integer|min:1|max:9999',
        'brand_id' => 'required|exists:brands,id',
        'category_id' => 'required|exists:categories,id',
        'enable' => 'boolean',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ordersDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
