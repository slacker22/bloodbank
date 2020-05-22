<?php

namespace App\Http\Controllers;

use App\Donors;
use App\Http\Resources\DonorResource;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ImportExcelController extends Controller
{
    function index()
    {
        //$data = DB::table('users')->orderBy('id','DESC')->get();
        return DonorResource::collection(Donors::whereIn('donor_type_id',[1])->get());

    }

    function import(Request $request)
    {

        $this->validate($request,[
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();

        Excel::import(new UsersImport,$path);



    }
}
