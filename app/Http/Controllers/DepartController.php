<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartController extends Controller
{
    public function index()
    {
        $departs = DB::select('SELECT * FROM depart');
        return view('depart.index', [
            'departamentos' => $departs,
        ]);
    }
}
