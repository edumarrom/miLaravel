<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleController extends Controller
{
    public function index()
    {
        $emples = DB::select('SELECT * FROM emple e
                        LEFT JOIN depart d
                               ON e.depart_id = d.id ');
        return view('emple.index', [
            'empleados' => $emples,
        ]);
    }
}
