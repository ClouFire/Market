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
    public function orderSuccess()
    {
        return view('orderSuccess');
    }
    public function addToCart()
    {

        $model = new Cart();
        $model->loadData();
        $return_url = str_replace('/Market', '', $model->attrs['return_url']);
        $model->attrs['user_id'] = \PHPFramework\Auth::user()['id'];
        $amount = $model->attrs['product_cart_amount'];
        $model->attrs['product_id'] = decrypt($model->attrs['product_id']);
        $model->attrs['product_amount'] = decrypt($model->attrs['product_amount']);
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
                response()->redirect('/checkout');
                die;
            }
            session()->setFlash('success', 'Success!');
            return $this->checkout($coupon, true);
        }
        else
        {
            session()->setFlash('error', 'coupon does not exist');
            response()->redirect('/checkout');
            die;
        }
    }

    public function checkout($params = [], $coupon = false)
    {
        $model = new Cart();
        $model->getUserGoods();
        return view('checkout', ['title' => 'Checkout', 'cart' => $model->attrs, 'params' => $params, 'coupon' => $coupon]);
    }

    public function placeOrder()
    {
        $model = new Cart();
        $model->loadOrderData();
        if(!$model->validate())
        {
            session()->setFlash("error", "Validation error");
            session()->set('form_errors', $model->getErrors());
            response()->redirect('/checkout');
        }
        else
        {
            $data = request()->getData();
            if($data['price'] == 0 and !isset($data['props']))
            {
                session()->setFlash('error', 'You don\'t have any products in ur cart!');
                response()->redirect('/checkout');
                die;
            }
            $country_id = db()->execute("SELECT id FROM countries WHERE name = ?", [$data['c_country']])->getStatement()->fetchAll()[0]['id'];
            db()->execute("INSERT INTO orders(user_id, country_id, delivery_date, company, adress, zip, phone, total, notes) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                getUserId(),
                $country_id,
                time() + 60*60*24*7,
                $data['c_companyname'],
                $data['c_state_country'] . '/' . $data['c_address'],
                $data['c_postal_zip'],
                $data['c_phone'],
                $data['price'],
                $data['c_order_notes'],
            ]);
            $order_id = db()->getInsertId();
            if($order_id)
            {
                foreach($data['props'] as $id => $amount)
                {
                    db()->execute("INSERT INTO order_item(order_id, good_id, amount) VALUES (?, ?, ?)", [$order_id, $id, $amount]);
                }
                if(isset($data['coupon']))
                {
                    db()->execute("UPDATE coupons SET usages = usages - 1 WHERE `coupons`.`id` = ?", [$data['coupon']]);
                }
                $cart_id = db()->findOne('cart', getUserId(), 'user_id')['id'];
                $cart_sum = db()->execute("SELECT * FROM cart_item WHERE cart_id = ?", [$cart_id])->getStatement()->fetchAll();
                $cart_sum = count($cart_sum);
                db()->execute("UPDATE cart SET total = total - {$cart_sum} WHERE id = ?", [$cart_sum]);
                db()->execute("DELETE FROM cart_item WHERE cart_id = ?", [$cart_id]);
            }
            response()->redirect('/orderSuccess');
        }
    }
}