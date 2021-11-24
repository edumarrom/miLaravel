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
                           LEFT JOIN depart d
                                  ON depart_id = d.id');
        return view('emple.index', [
            'empleados' => $empleados,
        ]);
    }

    public function show($id)
    {
        $empleado = $this->findEmpleado($id);

        return view('emple.show', [     // TODO: Crear vista show, con cada campo como una fila
            'empleado' => $empleado,
        ]);
    }

    public function create()
    {
        return view('emple.create');
    }

    public function destroy($id)
    {
        $this->findEmpleado($id);   // No es necesario guardar el valor de retorno de esta función.

        DB::delete('DELETE FROM emple WHERE id = ?', [$id]);

        return redirect()->back()
            ->with('success', 'Empleado borrado correctamente');
    }

    private function findEmpleado($id)
    {
        $empleado = DB::select('SELECT e.*, d.denominacion
                                  FROM emple e
                             LEFT JOIN depart d
                                    ON depart_id = d.id
                                 WHERE e.id = ?', [$id]);

        abort_unless($empleado, 404);

        return $empleado[0];
    }
}
