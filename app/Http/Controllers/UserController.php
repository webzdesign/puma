<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public $route = 'user';
    public $view = 'admin.user';
    public $moduleName = 'User';

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view.'/index',compact('moduleName'));
    }

    public function getUserData()
    {
        $data = User::with('role')->where('role_id','!=','1')->get();
        $datatable = datatables()->eloquent($data)
        ->addIndexColumn()
        ->addColumn('action', function(){
            $actions = '';
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
        return $datatable;
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        return view($this->view.'/create',compact('moduleName'));
    }

    public function store(UserRequest $request)
    {
        return "okk";
    }
}
