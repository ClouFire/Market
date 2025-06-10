<?php

namespace App\Controllers;

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
        session()->setFlash('content', 'U`ve successfully signed up for mailing');
        response()->redirect('/');
    }

    public function shop()
    {
        return view('shop', ['title' => 'Shop']);
    }

}