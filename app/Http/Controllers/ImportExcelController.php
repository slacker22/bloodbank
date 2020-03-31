<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class ImportExcelController extends Controller
{
    function index()
    {
        $data = DB::table('users')->orderBy('id','DESC')->get();
        //return view('import_excel', compact('data'));
    }

    function import(Request $request)
    {
        $this->validate($request,[
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count() > 0)
        {
            foreach ($data->toArray() as $key => $value)
            {
                foreach ($value as $row)
                {
                    $insert_data[] = array(

                    );
                }
            }

            if(!empty($insert_data))
            {
                DB::table('users')->insert($insert_data);
            }
        }
        return back()->with('success', 'Excel Data Imported successfully.');
    }
}
