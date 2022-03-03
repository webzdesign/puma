<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;

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
        $data = User::with('role')->where('role_id','!=','1')->select('*');
        $datatable = datatables()->eloquent($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $editUrl = route('user.edit', encrypt($row->id));
            $viewUrl = route('user.view', encrypt($row->id));
            $deleteUrl = route('user.delete', encrypt($row->id));
            $activeUrl = route('user.activeInactive', encrypt($row->id));
            $InactiveUrl = route('user.activeInactive', encrypt($row->id));

            $actions = '';
            if (auth()->user()->hasPermission('edit.users')) {
                $actions .= "<a href='" . $editUrl . "' class='btn btn-success btn-xs btn-sm'><i class='fas fa-pencil-alt'></i> Edit</a>";
            }
            if ($row->status == '0') {
                if (auth()->user()->hasPermission('activeinactive.users')) {
                    $actions .= " <a id='activate' href='" . $activeUrl . "' class='btn btn-success btn-xs btn-sm activeUser'><i class='fa fa-check'></i> Activate</a>";
                }
            } else {
                if (auth()->user()->hasPermission('activeinactive.users')) {
                $actions .= " <a id='inactivate' href='" . $InactiveUrl . "' class='btn btn-danger btn-xs btn-sm inactiveUser'><i class='fa fa-times'></i> In-activate</a>";
                }
            }
            if (auth()->user()->hasPermission('delete.users')) {
                $actions .= " <a id='deleteuser' href='" . $deleteUrl . "' class='btn btn-danger btn-xs btn-sm'><i class='fas fa-trash'></i> Delete</a>";
            }
            if (auth()->user()->hasPermission('view.users')) {
                $actions .= " <a href='" . $viewUrl . "' class='btn btn-info btn-xs btn-sm'><i class='fas fa-eye'></i> View</a>";
            }

            return $actions;
        })
        ->rawColumns(['action'])
        ->make(true);
        return $datatable;
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        // $roles = Role::active()->get();
        $roles = Role::all();
        return view($this->view.'/create',compact('moduleName', 'roles'));
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name  = ucfirst(trim($request->name));
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->status = $request->is_active;
        $user->password = Hash::make($request->password);

        $user->save();

        $user->detachAllRoles();
        $user->attachRole($request->role_id);
        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);
    }

    public function edit($id)
    {
        return "okk";
        // $moduleName = $this->moduleName;
        // $user = User::find(decrypt($id));
        // $role = Role::active()->get();
        // return view($this->view .'/view', compact('moduleName', 'user', 'role'));
    }
}
