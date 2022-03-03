<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

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

}
