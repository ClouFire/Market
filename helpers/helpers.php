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
    $end = $breadcrumbs[count($breadcrumbs)-1];
    if(str_contains($end, 'product?id=') and $names) $end = str_replace("product?id={$names['product']['id']}", "{$names['product']['name']}", $end);
    $html .= '<strong class="text-black">' . ucfirst($end) . '</strong></div></div></div></div>';
    return $html;
}

function getCartTotal($user_id)
{
    db()->execute("SELECT total FROM cart WHERE user_id = {$user_id}");
    return(db()->getStatement()->fetchAll());
}

function getUserId()
{
    return PHPFramework\Auth::user()['id'];
}

function getUserCartId()
{
    return db()->findOne('cart', getUserId(), 'user_id')['id'];
}

