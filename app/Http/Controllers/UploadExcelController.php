<?php

namespace App\Http\Controllers;

use App\Imports\PeoplesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadExcelController extends Controller
{
    //
    public function __construct()
    {
    }
    public function show()
    {
        return view("upload");
    }
    public function import(Request $request)
    {
        // Ensure that the 'file' field is present, is a file and is either in xlsx or xls format
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $array = Excel::toArray(new PeoplesImport, $file);
        dd($array);
    }
}
