<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SvgOrderProduct extends Model
{
    use HasFactory;
    protected $table = 'svg_order_products';
    protected $fillable  = [
        'product_id',
        'svg_order_id',
        'quantity',
        'variation',
    ];



    public function orderdProducts() : HasMany
    {
        return $this->hasMany(Product::class , 'product_id');
    }
}
