<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Requests\CustomerGroupRequest;
use App\Models\CustomerGroup;

class CustomerGroupController extends Controller
{
    public $route = 'customerGroup';
    public $view = 'admin.customerGroup';
    public $moduleName = 'Customer Group';

    public function index()
    {
        $moduleName = $this->moduleName;
        $route = $this->route;
        return view($this->view . '/index', compact('moduleName','route'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        $route = $this->route;
        return view($this->view . '/create', compact('moduleName','route'));
    }

    public function getCustomerGroupData()
    {
        $auth = auth()->user();
        $customerGroups = CustomerGroup::with('addedBy')->select('*');

        $datatable = datatables()->eloquent($customerGroups)
        ->addIndexColumn()
        ->addColumn('action', function ($customerGroup) use($auth) {

            $editurl = route('customerGroup.edit', encrypt($customerGroup->id));
            $activeurl = route('customerGroup.activeinactive', ['active', encrypt($customerGroup->id)]);
            $deactiveurl = route('customerGroup.activeinactive', ['deactive', encrypt($customerGroup->id)]);
            $deleteurl = route('customerGroup.delete', encrypt($customerGroup->id));

            $action = "";
            if(auth()->user()->hasPermission('edit.customerGroup')) {
                $action .= "<a href='".$editurl."' class='btn btn-xs btn-success'><i class='fas fa-pencil-alt'></i> Edit</a>";
            }
            if (auth()->user()->hasPermission('activeinactive.customerGroup')) {
                if($customerGroup->status == '0') {
                    $action .= " <a href='".$activeurl."' class='btn btn-xs btn-sm btn-success activate'><i class='fa fa-check'></i> Activate</a>";
                } else {
                    $action .= " <a href='".$deactiveurl."' class='btn btn-xs btn-sm btn-danger deactivate'><i class='fa fa-times'></i> Deactivate</a>";
                }
            }
            if (auth()->user()->hasPermission('delete.customerGroup')) {
                $action .= " <a id='deleteuser' href='" . $deleteurl . "' class='btn btn-danger btn-xs delete'><i class='fas fa-trash'></i> Delete</a>";
            }
            return $action;
        })
        ->editColumn('added_by', function ($customerGroup) {
            return $customerGroup->addedBy->name;
        })
        ->editColumn('status', function ($customerGroup) {
            if ($customerGroup->status == '1') {
                $action = " <label class='badge btn-xs btn-sm btn-success'> Activate</label>";
            } else {
                $action = " <label class='badge btn-xs btn-sm btn-danger'> Inactivate</label>";
            }
            return $action;
        })
        ->rawColumns(['action', 'status','added_by'])
        ->make(true);
        return $datatable;
    }

    public function store(CustomerGroupRequest $request)
    {
        $customer_group = CustomerGroup::create([
            'name'          => trim($request->name),
            'slug'          => str_slug($request->name),
            'status'        => ($request->status) ?? 1,
            'added_by'      => auth()->user()->id,
            'updated_by'    => auth()->user()->id,
        ]);

        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $route = $this->route;
        $customerGroup = CustomerGroup::find(decrypt($id));
        return view($this->view.'/edit', compact('moduleName','route','customerGroup'));
    }

    public function update(CustomerGroupRequest $request, $id)
    {
        $customerGroup              = CustomerGroup::find($id);
        $customerGroup->name        = trim($request->name);
        $customerGroup->slug        = str_slug($request->name);
        $customerGroup->status      = ($request->status) ?? $customerGroup->status;
        $customerGroup->updated_by  =  auth()->user()->id;
        $customerGroup->save();

        Helper::successMsg('update', $this->moduleName);
        return redirect($this->route);
    }

    public function delete($id)
    {
        $customerGroup = CustomerGroup::find(decrypt($id));
        $customerGroup->delete();
        Helper::successMsg('delete', $this->moduleName);
        return redirect($this->route);
    }

    public function activeinactive($type, $id)
    {
        if ($type == 'active') {
            CustomerGroup::where('id', decrypt($id))->update(['status' => '1']);
            Helper::successMsg('active', $this->moduleName);
        } else {
            CustomerGroup::where('id', decrypt($id))->update(['status' => '0']);
            Helper::successMsg('in_active', $this->moduleName);
        }
        return redirect($this->route);
    }

    public function checkCustomerGroupName(Request $request)
    {
        if (!isset($request->id)) {
            $check = CustomerGroup::where('name', trim(strtolower($request->name)))->count();
        } else {
            $check = CustomerGroup::where('name', trim(strtolower($request->name)))->where('id', '!=', $request->id)->count();
        }

        if ($check > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
