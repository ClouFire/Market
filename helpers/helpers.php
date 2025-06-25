<?php

function app(): \PHPFramework\Application
{
    return \PHPFramework\Application::$app;
}

function request(): \PHPFramework\Request
{
    return app()->request;
}

function response(): \PHPFramework\Response
{
    return app()->response;
}

function view($view = '', $data = [], $layout = ''): string|\PHPFramework\View
{
    if($view)
    {
        if($page = cache()->get($view)) return $page; 
        return app()->view->render($view, $data, $layout);
    }
    return app()->view;
}

function abort($error = '', $code = 404): void
{
    response()->setResponseCode($code);
    echo view("errors/{$code}", ['error'=> $error], false);
    die;
}

function baseUrl($path = ''): string
{
    return PATH . $path;
}

function db(): \PHPFramework\Database
{
    return app()->db;
}

function session(): \PHPFramework\Session
{
    return app()->session;
}

function cache(): \PHPFramework\Cache
{
    return app()->cache;
}
function get_alerts(): void
{
    if (!empty($_SESSION['flash']))
    {
        foreach($_SESSION['flash'] as $key => $msg)
        {
            echo view()->renderPartial("incs/alert_{$key}", ["flash_{$key}" => session()->getFlash($key)]);
        }
    }    
}


function get_errors($field): string
{
    $output = '';
    $errors = session()->get('form_errors');
    if(isset($errors[$field]))
    {
        $output .= '<div class="invalid-feedback d-block"><ul class="list-unstyled">';
        foreach($errors[$field] as $error)
        {
            $output .= "<li>$error</li>";
        }
        $output .= '</ul></div>';
    }

    return $output;
}

function old($field): string
{
    return isset(session()->get('form_data')[$field]) ? h(session()->get('form_data')[$field]) : '';
}

function h($str): string
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function getValidationClass($field): string
{
    $errors = session()->get('form_errors');
    if(empty($errors)) return '';
    return isset($errors[$field]) ? 'is-invalid' : 'is-valid';
}

function getCsrfField(): string
{
    return '<input type="hidden" name="csrf_token" value="' . session()->get('csrf_token') .'">';
}

function isAuth(): bool
{
    return PHPFramework\Auth::isAuth();
}

function getBreadcrumbs(array $names = []): string
{
    $html = '<div class="custom-border-bottom py-3"> <div class="container"> <div class="row"> <div class="col-md-12 mb-0">';
    $breadcrumbs = explode('/', request()->uri);
    for($i = 0; $i < count($breadcrumbs)-1; $i++)
    {
        $html .= '<a href="' . baseUrl("/{$breadcrumbs[$i]}") . '">';
        if($breadcrumbs[$i] == 'Market') $breadcrumbs[$i] = 'Home';
        $html .= ucfirst($breadcrumbs[$i]) . '</a> <span class="mx-2 mb-0">/</span>';

    }
    if(request()->isGet())
    {
        if(request()->get('shop') === "")
        {
            $html .= '<a href="' . baseUrl("/shop") . '">' . 'Shop' . '</a>';
            if(count(request()->getData()) > 1) $html .= '</a> <span class="mx-2 mb-0">/</span>';
        }
        if(request()->get('id'))
        {
            $html .= '<strong class="text-black">' . "{$names['product']['name']}" . '</strong>';
        }
        if(request()->get('category'))
        {
            $html .= '<strong class="text-black">' . request()->get('category') . '</strong>';
        }
        $html .= '</div></div></div></div>';
    }
    return $html;
}

function getCartTotal($user_id)
{
    db()->execute("SELECT total FROM cart WHERE user_id = {$user_id}");
    return(db()->getStatement()->fetchAll()[0]['total']);
}

function getUserId()
{
    return PHPFramework\Auth::user()['id'];
}

function getUserCartId()
{
    return db()->findOne('cart', getUserId(), 'user_id')['id'];
}

function getUserCartItem($product_id)
{
    return db()->execute("SELECT id FROM cart_item WHERE good_id = ? AND cart_id = ?", [$product_id, getUserCartId()])->getStatement()->fetchAll();
}

function getTotalPrice($cart, $params = [])
{
    if(!isset($cart['price'])) return '0';
    $total = 0;
    {
        for($i = 0; $i < count($cart['price']); $i++)
        {
            $total += $cart['price'][$i] * $cart['quantity'][$i];
        }
    }
    if($params)
    {
            if($params['type'] == 'percent') return $total * (1 - $params['percent']);
            if($params['type'] == 'amount') return ($total - $params['amount'] > 0) ?  $total - $params['amount'] : 0;
    }
    return $total;
}

function encrypt($value, $key = ENCRYPTION_KEY)
{
    $key = hash('sha256', $key, true);
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $cryptvalue = openssl_encrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $cryptvalue);
}

function decrypt($encoded, $key = ENCRYPTION_KEY)
{
    $key = hash('sha256', $key, true);
    $decoded = base64_decode($encoded);
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($decoded, 0, $ivLength);
    $cryptvalue = substr($decoded, $ivLength);

    return openssl_decrypt($cryptvalue, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
}