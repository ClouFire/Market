<?php

namespace App\Controllers;

use PHPFramework\Pagination;

class HomeController extends BaseController
{

    public function getHomePage()
    {
        return view('home', ['title' => 'Home page']);
    }

    public function contact()
    {
        return view('contact', ['title' => 'Contact']);
    }



    public function subscribe()
    {
        $return_url = str_replace('/Market', '', request()->post('return_url'));
        if(db()->findOne('subscribers', request()->post('email_subscribe')))
        {
            db()->insert('subscribers', ['email'], [request()->post('email_subscribe')]);
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

        if($category = request()->get('category'))
        {
            $products = db()->execute("SELECT * FROM goods JOIN good_catigories ON goods.id = good_catigories.good_id WHERE good_catigories.name = ?", [$category])->getStatement()->fetchAll();
            $pagination = new Pagination(count($products));
        }
        else
        {
            $pagination = new Pagination($products_count);
            $products = db()->findRange('goods', $limit, $pagination->getStart());
        }
        $pagination->getPages();
        return view('shop', [
            'title' => 'Shop',
            'products' => $products,
            'pagination' => $pagination,
            ]);
    }

    public function registerMessage()
    {
        $data = request()->getData();
        if($data['c_subject'])
        {
            db()->insert('contacts', ['name', 'email', 'subject', 'message'],
                [
                    $data['c_fname'] . ' ' . $data['c_lname'],
                    $data['c_email'],
                    $data['c_subject'],
                    $data['c_message'],
                ]);
        }
        else
        {
            db()->insert('contacts', ['name', 'email', 'message'],
                [
                    $data['c_fname'] . ' ' . $data['c_lname'],
                    $data['c_email'],
                    $data['c_message'],
                ]);
        }

        session()->setFlash('success', 'Your`s message had successfully sent to us');
        response()->redirect(baseUrl('/contact'));
        return db()->getInsertId();
    }
}