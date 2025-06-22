<?php

namespace App\Models;

use PHPFramework\Model;
class Cart extends Model
{
    protected string $table = 'cart';
    protected array $loaded = ['product_id', 'product_amount', 'return_url', 'product_cart_amount', 'shop_sizes'];

    protected array $fillable = ['image', 'title', 'price', 'quantity', 'good_id'];

}