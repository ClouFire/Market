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
}