<?php

namespace App\Controllers;
use App\Models\User;
use PDOException;
use PHPFramework\Pagination;

class UserController extends BaseController
{

    public function register()
    {
        return view("user/register", ["title" => "Register page",]);
    }

    public function store()
    {
        $model = new User();
        $model->loadData();
        $model->addValidationRule('uniqueName', function($field, $value, $params, $fields){
            $data = explode(',', $params[0]);
            $user = db()->findOne($data[0], $value, $data[1]);
            return !$user;
        }, 'This name already exists');
        $model->addValidationRule('uniqueEmail', function($field, $value, $params, $fields){
            $data = explode(',', $params[0]);
            $user = db()->findOne($data[0], $value, $data[1]);
            return !$user;
        }, 'This email already exists');
        
        if (!$model->validate())
        {
            session()->setFlash("error", "Validation error");
            session()->set('form_errors', $model->getErrors());
            session()->set('form_data', $model->attrs);
        }
        else
        {
            $model->attrs['password'] = password_hash($model->attrs['password'], PASSWORD_DEFAULT);
            if($id = $model->save())
            {
                session()->setFlash('success', 'Thx for reg');
            }
            else
            {
                session()->setFlash('error', 'Reg error');
            }
        }

        response()->redirect("/register");
    }

    public function login()
    {
        return view("user/login", ["title" => "Login page",]);
    }

    public function index()
    {
        $users_cnt = db()->countAll('users');
        $limit = PAGINATION_SETTINGS['perPage'];
        $pagination = new Pagination($users_cnt);
        $pagination->getPages();
        $users = db()->findRange('users', $limit, $pagination->getStart());

        return view('user/index', [
            'title' => 'Index page',
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

    public function cart(): string
    {
        return view("user/cart", ["title" => "Cart"]);
    }
}