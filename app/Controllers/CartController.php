<?php

namespace App\Controllers;

use App\Models\Cart;


class CartController
{
    public function addToCart()
    {

        $model = new Cart();
        $model->loadData();
        $return_url = str_replace('/Market', '', $model->attrs['return_url']);
        $model->attrs['user_id'] = \PHPFramework\Auth::user()['id'];
        $amount = $model->attrs['product_cart_amount'];
        if($amount > $model->attrs['product_amount'])
        {
            session()->setFlash('error', "There only {$model->attrs['product_amount']} on stock <br> You can not add more!");
            response()->redirect($return_url);
            die;
        }
        $good_id = $model->attrs['product_id'];
        $user_id = $model->attrs['user_id'];
        $cart_id = db()->findOne('cart', $user_id, 'user_id')['id'];
        $size = $model->attrs['shop_sizes'];
        db()->insertCartItem($cart_id, $good_id, $amount, $user_id, $size);
        session()->setFlash('success', "Successfully added to your cart!");
        response()->redirect($return_url);
        die;
    }
}