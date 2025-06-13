<?php

namespace App\Controllers;

use PHPFramework\Pagination;

class HomeController extends BaseController
{

    public function getHomePage()
    {
        return view('home', ['title' => 'Home page']);
    }

    public function dashboard()
    {
        return view('dashboard', ['title' => 'Dashboard page']);
    }

    public function subscribe()
    {
        $return_url = str_replace('/Market', '', $_POST['return_url']);
        if(db()->findOne('subscribers', $_POST['email_subscribe']))
        {
            db()->insert('subscribers', ['email'], [$_POST['email_subscribe']]);
            session()->setFlash('content', 'U`ve successfully signed up for mailing');
        }
        else
        {
            session()->setFlash('error', 'This email is already used');
        }
        response()->redirect($return_url);
    }

    public function shop()
    {
        $products_count = db()->countAll('goods');
        $limit = PAGINATION_SETTINGS['perPage'];
        $pagination = new Pagination($products_count);
        $pagination->getPages();
        $products = db()->findRange('goods', $limit, $pagination->getStart());
        return view('shop', [
            'title' => 'Shop',
            'products' => $products,
            'pagination' => $pagination,
            ]);
    }

}