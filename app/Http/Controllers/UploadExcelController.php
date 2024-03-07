<?php

namespace App\Http\Controllers;

use App\Imports\PeoplesImport;
use App\Jobs\StorePeopleJob;
use Illuminate\Http\JsonResponse;
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
    public function import(Request $request): JsonResponse
    {
        // Ensure that the 'file' field is present, is a file and is either in xlsx or xls format
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $array = (Excel::toArray(new PeoplesImport, $file))[0];
        array_shift($array);
        StorePeopleJob::dispatch($array);
        return response()->json(['status' => 'Document in process']);
    }
}
