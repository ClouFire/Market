<?php

function getProductsCards($value, $amount = 1, $key = 'id')
{
    $card = '';
    $products = db()->execute("SELECT * FROM goods WHERE " . $key . " = ? LIMIT " . $amount, [$value])->get();
    if(!$products) return '';
    foreach($products as $product)
    {
        $card .= '<div class="col-lg-4 col-md-6 item-entry mb-4"><a href="' . baseUrl("/shop/product?id={$product['id']}") . '" class="product-item md-height bg-gray d-block">'
            . '<img src="' . baseUrl("/assets/{$product['image']}") . '" alt="Image" class="img-fluid"> </a>' .
            '<h2 class="item-title"><a href="' . baseUrl("/shop/product?id={$product['id']}") . '">' . $product['title'] . '</a></h2>' . '<strong class="item-price">' . '$' . $product['price'] . '.00' . '</strong>';
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
        $cards .= '<div class="item"> <div class="item-entry"> <a href="' . baseUrl("/shop/product?id={$product['id']}") . '" class="product-item md-height bg-gray d-block">' .
            '<img src="'. baseUrl("/assets/{$product['image']}") . '" alt="Image" class="img-fluid"> </a>' .
            '<h2 class="item-title"><a href="' . baseUrl("/shop/product?id={$product['id']}") . '">' . $product['title'] . '</a></h2>' .
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
        '<a href="' . baseUrl("/shop/product?id={$product['id']}") . '" class="product-item md-height bg-gray d-block">' .
        '<img src="'. baseUrl("/assets/{$product['image']}") .'" alt="Image" class="img-fluid"> </a>' .
        '<h2 class="item-title"><a href="' . baseUrl("/shop/product?id={$product['id']}") . '">' . $product['title'] . '</a></h2>' .
        '<strong class="item-price">$' . $product['price'] . '.00</strong></div>';

    return $card;
}

function getPropertyHref($property)
{
    return "?category={$property}";
}

function getCartRow($cart)
{
    if(!isset($cart['image'])) return '';
    $html = '';
    for($i = 0; $i < count($cart['image']); $i++)
    {
        $html .= '<tr>'
            . '<td class="product-thumbnail">'
            . '<img src="' . baseUrl("/assets/{$cart['image'][$i]}") . '" alt="Image" class="img-fluid">'
            . '</td>'
            . '<td class="product-name">'
            . '<h2 class="h5 text-black">' . $cart['title'][$i] . '</h2>'
            . '</td>'
            . '<td>$' . $cart['price'][$i] . '.00</td>'
            . '<td>' . $cart['quantity'][$i] . '</td>'
            . '<td>$' . $cart['price'][$i] * $cart['quantity'][$i] . '.00</td>'
            . '<td><form action="' . baseUrl('/cart') .'" method="post"><button class="btn btn-primary height-auto btn-sm">X</button>'
            . getCsrfField()
            . '<input type="hidden" name="good_id" value="' . $cart['good_id'][$i] . '">'
            . '</form></td>'
            . '</tr>';
    }
    return $html;
}

function getCollections()
{
    $html = '<div class="site-section"><div class="container"><div class="title-section mb-5"><h2 class="text-uppercase"><span class="d-block">Discover</span> The Collections</h2></div><div class="row align-items-stretch"><div class="col-lg-8">';
    foreach(['Women' => 'model_4.png', 'Men' => 'model_5.png', 'Shoes' => 'model_6.png'] as $k => $v)
    {
        $count = countItems('good_catigories', "{$k}");
        $word = $count > 1 ? "items" : "item";
        $src = baseUrl("/assets/images/{$v}");
        $html .= '<div class="col-lg-4"><div class="product-item sm-height full-height bg-gray"><button onclick="window.location.href=' . baseUrl('/shop') . getPropertyHref("{$k}") . '\'" class="product-category">' . $k . '<span>'
            . $count . $word . '</span></button>'
        . '<img src="' . $src . '" alt="Image" class="img-fluid">'
        . '</div></div></div>';
    }
    $html .= '</div></div>';
    return $html;
}

?>