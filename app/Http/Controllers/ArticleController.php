<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Imports\ArticleImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ArticleController extends Controller
{
    public function importExportView()
    {

        return view('import');
    }

    /**

     * @return \Illuminate\Support\Collection

     */

    public function import()
    {

        $array = Excel::toArray(new ArticleImport, request()->file('file'));
        dd($array[0]);
        // Excel::import(new ArticleImport, $array); //)->store('temp')

        // $import = new ArticleImport();
        // Excel::import($import, request()->file('file'));
        // foreach ($import->data as $user) {
        //     //sends email to all users
        //     $this->sendEmail($user->email, $user->name);
        // }

        Helper::successMsg('update', '$this->moduleName');
        return back();
    }
}
