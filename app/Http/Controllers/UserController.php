<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $route = 'user';
    public $view = 'admin.user';
    public $moduleName = 'User';

    public function index()
    {
        $moduleName = $this->moduleName;
        $roles = Role::active()->get();
        return view($this->view.'/index',compact('moduleName','roles'));
    }

    public function getUserData(Request $request)
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
                $actions .= "<a href='" . $editUrl . "' class='btn btn-success btn-xs'><i class='fas fa-pencil-alt'></i> Edit</a>";
            }
            if ($row->status == '0') {
                if (auth()->user()->hasPermission('activeinactive.users')) {
                    $actions .= " <a id='activate' href='" . $activeUrl . "' class='btn btn-success btn-xs activeUser'><i class='fa fa-check'></i> Activate</a>";
                }
            } else {
                if (auth()->user()->hasPermission('activeinactive.users')) {
                $actions .= " <a id='inactivate' href='" . $InactiveUrl . "' class='btn btn-danger btn-xs inactiveUser'><i class='fa fa-times'></i> In-activate</a>";
                }
            }
            if (auth()->user()->hasPermission('delete.users')) {
                $actions .= " <a id='deleteuser' href='" . $deleteUrl . "' class='btn btn-danger btn-xs'><i class='fas fa-trash'></i> Delete</a>";
            }
            if (auth()->user()->hasPermission('view.users')) {
                $actions .= " <a href='" . $viewUrl . "' class='btn btn-info btn-xs'><i class='fas fa-eye'></i> View</a>";
            }

            return $actions;
        })
        ->filter(function ($instance) use ($request) {
            if (!empty($request->get('role_id'))) {
                 $instance->where(function($w) use($request){
                    $w->orWhere('role_id', $request->role_id)
                    ->orWhere('role_id', $request->role_id);
                });
            }
        })
        ->rawColumns(['action'])
        ->make(true);
        return $datatable;
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        $roles = Role::active()->get();
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
        $added_by = Auth::id();
        $user->added_by = $added_by;

        $user->save();

        $user->detachAllRoles();
        $user->attachRole($request->role_id);
        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);
    }

    public function edit($id)
    {
        // return "okk";
        $moduleName = $this->moduleName;
        $user = User::find(decrypt($id));
        $role = Role::active()->get();
        return view($this->view .'/view', compact('moduleName', 'user', 'role'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name  = ucfirst(trim($request->name));
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->status = $request->is_active; 
        $updated_by = Auth::id();
        $user->updated_by = $updated_by;

        $user->save();

        $user->detachAllRoles();
        $user->attachRole($request->role_id);
        if (basename(url()->previous()) == 'home') {
            return redirect()->route('home')->with("msg", "<div class='alert alert-success alert-dismissible fade show' role='alert'>Profile Updated Successfully !");
        }
        Helper::successMsg('update', $this->moduleName);
        return redirect($this->route);
    }

    public function delete($id)
    {
        $user = User::find(decrypt($id));
        $user->delete();
        Helper::successMsg('delete', $this->moduleName);
        return redirect($this->route);
    }

    public function view($id)
    {
        $module = $this->moduleName;
        $user = User::with('role')->find(decrypt($id));
        return view($this->view .'/view', compact('module', 'user'));
    }

    public function activeInactive($id)
    {
        $status = User::where('id', decrypt($id))->pluck('status');
        if ( $status[0] == 0 ) {
            User::where('id', decrypt($id))->update(['status' => '1']);
            Helper::successMsg('active', $this->moduleName);
        } else {
            User::where('id', decrypt($id))->update(['status' => '0']);
            Helper::successMsg('in_active', $this->moduleName);
        }
        return redirect($this->route);
    }
}
