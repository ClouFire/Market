<?php

namespace App\Controllers;

use PHPFramework\Controller;

class BaseController extends Controller
{
    
    public function __construct()
    {
        // app()->set('test', 'value');
        app()->set('menu', $this->renderMenu());
        app()->set('news', $this->renderLastNews());
        if(!$menu = cache()->get('menu')) cache()->set('menu', $this->renderMenu());
        if(!$menu = cache()->get('news')) cache()->set('news', $this->renderLastNews());
    }

    public function renderMenu(): string //Можно сделать через запрос к БД и оттуда уже сформировать готовую верстку, но "так как проект локальный, воспользуюсь локальным хранилищем" (проверить эту теорию в гпт)
    {
        return view()->renderPartial('incs/menu');
    }

    public function renderLastNews(): string
    {
        return view()->renderPartial('incs/last_news');
    }
}