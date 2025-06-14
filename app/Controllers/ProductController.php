<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    public function product()
    {
        $id = request()->get('id');
        $model = new Product();
        $model->getProduct($id);
        return view('/product', ['product' => $model->attrs]);
    }
}