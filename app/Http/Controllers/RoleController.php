<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\PermissionRole;
use App\Models\User;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class RoleController extends Controller
{
    public $route = 'role';
    public $view = 'admin.role';
    public $moduleName = 'Role';

    public function index()
    {
        $moduleName = $this->moduleName;
        return view($this->view . '/index', compact('moduleName'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        $permissions = Permission::get()->groupBy('model');
        return view($this->view . '/create', compact('moduleName', 'permissions'));
    }

    public function getRoleData()
    {
        $auth = auth()->user();
        $roles = Role::select('*');

        $datatable =  datatables()->eloquent($roles)
            ->addColumn('action', function ($role) use ($auth) {

                $editUrl = route('role.edit', encrypt($role->id));
                $activeUrl = route('role.activeinactive', ['active', encrypt($role->id)]);
                $deactiveUrl = route('role.activeinactive', ['deactive', encrypt($role->id)]);
                $deleteUrl = route('role.delete', encrypt($role->id));

                $action = "";

                if (auth()->user()->hasPermission('edit.roles')) {
                    $action .=  "<a href='" . $editUrl . "' class='btn btn-sm btn-success'><i class='fas fa-pencil-alt'></i> Edit</a>";
                }
                if (auth()->user()->hasPermission('activeinactive.roles')) {
                    if ($role->status == '0') {
                        $action .= " <a id='activate' href='" . $activeUrl . "' class='btn btn-sm btn-success activeUser'><i class='fa fa-check'></i> Activate</a>";
                    } else {
                        $action .= " <a id='deactivate' href='" . $deactiveUrl . "' class='btn btn-sm btn-danger inactiveUser'><i class='fa fa-times'></i> Deactivate</a>";
                    }
                }

                if (auth()->user()->hasPermission('destroy.roles')) {
                    $action .= " <a id='delete' href='$deleteUrl' class='btn btn-sm btn-danger deleteUser'><i class='fa fa-trash'></i> Delete</a>";
                }

                return $action;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

        return $datatable;
    }

    public function store(Request $request)
    {

        $role = Role::create([
            'name'          => $request->name,
            'slug'          => str_slug($request->name),
            'description'   => $request->description,
            'status'     => $request->status,
        ]);

        $role->attachPermission($request->permission);

        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $role = Role::find(decrypt($id));
        $permissions = Permission::get()->groupBy('model');

        $existPermissions = PermissionRole::where('role_id', decrypt($id))->pluck('permission_id')->toArray();

        return view($this->view . '/edit', compact('moduleName', 'role', 'permissions', 'existPermissions'));
    }

    public function update(Request $request, $id)
    {
        $role               = Role::find($id);
        $role->name         =  $request->name;
        $role->slug         =  str_slug($request->name);
        $role->description  =  $request->description;
        $role->status    =  $request->status;
        // $role->updated_by   =  auth()->user()->id;
        $role->save();

        $role->syncPermissions($request->permission);

        $users = User::where('role_id', $id)->get();

        foreach ($users as $user) {
            $user->detachAllRoles();
            $user->attachRole($id);
        }


        Helper::successMsg('update', $this->moduleName);
        return redirect($this->route);
    }

    public function delete($id)
    {
        $role = Role::find(decrypt($id));
        // dd($role->users->count());
        if ($role->users->count() == 0) {
            PermissionRole::where('role_id', decrypt($id))->delete();
            $role->delete();
            Helper::successMsg('delete', $this->moduleName);
            // return redirect($this->route);
        } else {
            Helper::failarMsg('custom', "This role have already some users.");
        }
        return redirect($this->route);
    }

    public function activeinactive($type, $id)
    {
        if ($type == 'active') {
            Role::where('id', decrypt($id))->update(['status' => '1']);
            Helper::successMsg('active', $this->moduleName);
        } else {
            Role::where('id', decrypt($id))->update(['status' => '0']);
            Helper::successMsg('in_active', $this->moduleName);
        }
        return redirect($this->route);
    }

    public function checkRole(Request $request)
    {
        if (!isset($request->id)) {
            $checkRole = Role::where('name', trim($request->name))->count();
        } else {
            $checkRole = Role::where('name', trim($request->name))->where('id', '!=', $request->id)->count();
        }

        if ($checkRole > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
