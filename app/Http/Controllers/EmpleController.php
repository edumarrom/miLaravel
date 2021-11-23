<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleController extends Controller
{
    public function index()
    {
        $empleados = DB::select('SELECT e.*, d.denominacion
                                FROM emple e
                                JOIN depart d
                                  ON depart_id = d.id');
        return view('emple.index', [
            'empleados' => $empleados,
        ]);
    }

    public function show($id)
    {
        $empleado = $this->findEmpleado($id);

        return view('emple.show', [
            'empleado' => $empleado,
        ]);
    }

    private function findEmpleado($id)
    {
        $empleado = DB::select('SELECT e.*, d.denominacion
                                  FROM emple e
                                  JOIN depart d
                                    ON depart_id = d.id
                                 WHERE e.id = ?', [$id]);

        abort_unless($empleado, 404);

        return $empleado[0];
    }
}
