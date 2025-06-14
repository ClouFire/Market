<?php

function getProductsCards($value, $amount = 1, $key = 'id')
{
    $card = '';
    $products = db()->execute("SELECT * FROM goods WHERE " . $key . " = ? LIMIT " . $amount, [$value])->get();
    if(!$products) return '';
    foreach($products as $product)
    {
        $card .= '<div class="col-lg-4 col-md-6 item-entry mb-4"><a href="#" class="product-item md-height bg-gray d-block">'
            . '<img src="' . baseUrl("/assets/{$product['image']}") . '" alt="Image" class="img-fluid"> </a>' .
            '<h2 class="item-title"><a href="' . baseUrl('/product') . '">' . $product['name'] . '</a></h2>' . '<strong class="item-price">' . '$' . $product['price'] . '.00' . '</strong>';
        if($product['raiting'] > 0)
        {
            $card .= '<div class="star-rating">';
            for($i = 0; $i < $product['raiting']; $i++)
            {
                $card .= '<span class="icon-star2 text-warning"></span>';
            }
            $card .= '</div>';
        }
        $card .= '</div>';
    }
    return $card;
}

function getMostRated($amount)
{
    $cards = '';
    $products = db()->execute("SELECT * FROM goods WHERE raiting > 0 ORDER BY raiting DESC LIMIT $amount")->get();
    if(!$products) return '';
    foreach($products as $product)
    {
        $cards .= '<div class="item"> <div class="item-entry"> <a href="#" class="product-item md-height bg-gray d-block">' .
            '<img src="'. baseUrl("/assets/{$product['image']}") . '" alt="Image" class="img-fluid"> </a>' .
            '<h2 class="item-title"><a href="' . baseUrl('/product') . '">' . $product['name'] . '</a></h2>' .
            '<strong class="item-price">$' . $product['price'] . '.00</strong> <div class="star-rating">';
        for($i = 0; $i < $product['raiting']; $i++)
        {
            $cards .= '<span class="icon-star2 text-warning"></span>';
        }
        $cards .= '</div></div></div>';
    }
    return $cards;
}

function countItems($table, $filter)
{
    return db()->execute("SELECT count(*) FROM $table WHERE name = ?", [$filter])->getColumn();
}

function getSmallCards($product)
{
    $card = '<div class="col-lg-6 col-md-6 item-entry mb-4">' .
        '<a href="#" class="product-item md-height bg-gray d-block">' .
        '<img src="'. baseUrl("/assets/{$product['image']}") .'" alt="Image" class="img-fluid"> </a>' .
        '<h2 class="item-title"><a href="' . baseUrl('/product') . '">' . $product['name'] . '</a></h2>' .
        '<strong class="item-price">$' . $product['price'] . '.00</strong></div>' .
        '<input type="hidden" name="return_url" value="' . $product . '">';

    return $card;
}



