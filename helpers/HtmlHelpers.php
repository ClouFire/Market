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

function getOptions()
{
    $html = '<option value="1">Select a country</option>';
    $data = db()->findAll('countries');
    foreach($data as $country)
    {
        $html .= '<option value="' . $country['name'] . '">' . $country['name'] . '</option>';
    }
    return $html;
}

function getCartTitles($cart)
{
    if(!isset($cart['title'])) return '';
    $html = '';
    for($i = 0; $i < count($cart['title']); $i++)
    {
        $html .= '<tr><td>' . $cart['title'][$i] . '<strong class="mx-2">x</strong>' . $cart['quantity'][$i] . '</td><td>$' . $cart['quantity'][$i] * $cart['price'][$i] . '.00</td></tr>';
    }
    return $html;
}

function getHiddenProps($cart)
{
    if(!isset($cart['title'])) return '';
    $html = '';
    for($i = 0; $i < count($cart['title']); $i++)
    {
        $html .= '<input type="hidden" name="props[' . $cart['good_id'][$i] . ']" value="' . $cart['quantity'][$i] . '">';

    }
    return $html;
}
?>