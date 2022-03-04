<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $route = 'category';
    public $view = 'admin.category';
    public $moduleName = 'Category';

    public function index()
    {
        $moduleName = $this->moduleName;
        $route = $this->route;
        return view($this->view . '/index', compact('moduleName', 'route'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;
        $route = $this->route;
        return view($this->view . '/create', compact('moduleName', 'route'));
    }


    public function getCategoryData()
    {
        $auth = auth()->user();
        $categorys = Category::with(['addedBy'])->select('*');

        $datatable =  datatables()->eloquent($categorys)
            ->addColumn('action', function ($category) use ($auth) {

                $editUrl = route('category.edit', encrypt($category->id));
                $activeUrl = route('category.activeinactive', ['active', encrypt($category->id)]);
                $deactiveUrl = route('category.activeinactive', ['deactive', encrypt($category->id)]);
                $deleteUrl = route('category.delete', encrypt($category->id));

                $action = "";
                if (auth()->user()->hasPermission('edit.category')) {
                    $action .=  "<a href='" . $editUrl . "' class='btn btn-xs btn-sm btn-success'><i class='fas fa-pencil-alt'></i> Edit</a>";
                }
                if (auth()->user()->hasPermission('activeinactive.category')) {
                    if ($category->status == '0') {
                        $action .= " <a id='activate' href='" . $activeUrl . "' class='btn btn-xs btn-sm btn-success activeUser'><i class='fa fa-check'></i> Activate</a>";
                    } else {
                        $action .= " <a id='deactivate' href='" . $deactiveUrl . "' class='btn btn-xs btn-sm btn-danger inactiveUser'><i class='fa fa-times'></i> Deactivate</a>";
                    }
                }

                return $action;
            })
            ->editColumn('added_by', function ($category) {
                return $category->addedBy->name;
            })
            ->editColumn('status', function ($category) {
                if ($category->status == '1') {
                    $action = " <label class='badge btn-xs btn-sm btn-success'> Activate</label>";
                } else {
                    $action = " <label class='badge btn-xs btn-sm btn-danger'> Inactivate</label>";
                }
                return $action;
            })
            ->rawColumns(['action', 'status','added_by'])
            ->addIndexColumn()
            ->make(true);

        return $datatable;
    }

    public function store(Request $request)
    {

        $category = Category::create([
            'name'          => trim($request->name),
            'slug'          => str_slug($request->name),
            'code'          => trim($request->code),
            'status'     => ($request->status) ?? 1,
            'added_by'     => auth()->user()->id,
            'updated_by'     => auth()->user()->id,
        ]);


        Helper::successMsg('insert', $this->moduleName);
        return redirect($this->route);
    }

    public function edit($id)
    {
        $moduleName = $this->moduleName;
        $route = $this->route;
        $category = Category::find(decrypt($id));

        return view($this->view . '/edit', compact('moduleName', 'category', 'route'));
    }

    public function update(Request $request, $id)
    {
        $category               = Category::find($id);
        $category->name         =  trim($request->name);
        $category->slug         =  str_slug($request->name);
        $category->code         =  trim($request->code);
        $category->status    =  ($request->status) ?? $category->status;
        $category->updated_by   =  auth()->user()->id;
        $category->save();

        Helper::successMsg('update', $this->moduleName);
        return redirect($this->route);
    }

    public function delete($id)
    {
        $category = Category::find(decrypt($id));
        if ($category->users->count() == 0) {
            $category->delete();
            Helper::successMsg('delete', $this->moduleName);
        } else {
            Helper::failarMsg('custom', "This category have already assigned.");
        }
        return redirect($this->route);
    }


    public function activeinactive($type, $id)
    {
        if ($type == 'active') {
            Category::where('id', decrypt($id))->update(['status' => '1']);
            Helper::successMsg('active', $this->moduleName);
        } else {
            Category::where('id', decrypt($id))->update(['status' => '0']);
            Helper::successMsg('in_active', $this->moduleName);
        }
        return redirect($this->route);
    }

    public function checkCategoryName(Request $request)
    {
        if (!isset($request->id)) {
            $check = Category::where('name', trim(strtolower($request->name)))->count();
        } else {
            $check = Category::where('name', trim(strtolower($request->name)))->where('id', '!=', $request->id)->count();
        }

        if ($check > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function checkCategoryCode(Request $request)
    {
        if (!isset($request->id)) {
            $check = Category::where('code', trim(strtolower($request->code)))->count();
        } else {
            $check = Category::where('code', trim(strtolower($request->code)))->where('id', '!=', $request->id)->count();
        }

        if ($check > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
