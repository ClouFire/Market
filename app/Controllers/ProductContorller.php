<?php

namespace App\Controllers;

class ProductContorller
{
    public function product()
    {
        return view('product', ['title' => 'Shop']);
    }
}