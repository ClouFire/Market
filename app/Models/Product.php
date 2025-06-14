<?php

namespace App\Models;

use PHPFramework\Model;

class Product extends Model
{
    protected string $table = 'goods';
    protected array $loaded = ['id', 'amount', 'price', 'raiting', 'image', 'name', 'description'];

}