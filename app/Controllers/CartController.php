<?php

namespace App\Controllers;

use App\Models\Cart;


class CartController
{
    public function cart($params = [])
    {
        $model = new Cart();
        $model->getUserGoods();
        return view('cart', ['cart' => $model->attrs, 'title' => 'Cart', 'params' => $params]);
    }
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

    public function deleteFromCart()
    {
        $data = request()->getData();
        db()->execute("DELETE FROM cart_item WHERE good_id = ?", [$data['good_id']]);
        db()->execute("UPDATE cart SET total = total - 1 WHERE cart.user_id = ?", [getUserId()]);
        response()->redirect('/cart');
    }

    public function editTotalPrice()
    {
        $coupon = db()->findOne('coupons', request()->post('coupon'), 'value');
        if($coupon)
        {
            if($coupon['created_at'] > $coupon['expires_at'] and $coupon['expires_at'] !== null and ($coupon['usages'] > 0 or $coupon['usages'] !== null))
            {
                session()->setFlash('error', 'coupon expired');
                response()->redirect('/cart');
                die;
            }
            if($coupon['usages'] !== null) db()->execute("UPDATE coupons SET usages = usages - 1 WHERE value = ?", [$coupon['value']]);
            session()->setFlash('success', 'Success!');
            return $this->cart($coupon);
        }
        else
        {
            session()->setFlash('error', 'coupon does not exist');
            response()->redirect('/cart');
            die;
        }
    }

    public function checkout()
    {
        return view('checkout', ['title' => 'Checkout']);
    }


}