<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public $route = 'user';
    public $view = 'users.userData';
    public $module = 'User';

    public function index()
    {
        $module = $this->module;
        return view($this->view.'/index',compact('module'));
    }

    public function getUserData()
    {
        $data = User::with('role')->where('role_id','!=','1')->get();
        return $data;
    }
}
