<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleController extends Controller
{
    public function index()
    {

        $empleados = DB::table('emple', 'e')
            ->leftJoin('depart AS d', 'depart_id', '=', 'd.id')
            ->select('e.*', 'denominacion')
            ->get();
       /*  $empleados = DB::select('SELECT e.*, d.denominacion
                                FROM emple e
                           LEFT JOIN depart d
                                  ON depart_id = d.id'); */
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

    public function store()
    {
        $validados = $this->validar();

        DB::table('Emple')
            ->insert([
                'nombre' => $validados['nombre'],
                'fecha_alt' => $validados['fecha_alt'],
                'salario' => $validados['salario'],
                'depart_id' => $validados['depart_id'],
        ]);

        return redirect('/Emple')
            ->with('success', 'Empleado insertado con éxito.');
    }

    public function edit($id)
    {
        $departamento = $this->findDepartamento($id);

        return view('depart.edit', [
            'departamento' => $departamento,
        ]);
    }

    public function destroy($id)
    {
        $this->findEmpleado($id);   // No es necesario guardar el valor de retorno de esta función.

        DB::table('emple')
            ->where('id', $id)
            ->delete();
        /* DB::delete('DELETE FROM emple WHERE id = ?', [$id]); */

        return redirect()->back()
            ->with('success', 'Empleado borrado correctamente');
    }

    private function findEmpleado($id)
    {
        $empleados = DB::table('emple', 'e')
            ->leftJoin('depart AS d', 'depart_id', '=', 'd.id')
            ->where('e.id', $id)
            ->select('e.*', 'denominacion')
            ->get();
/*         $empleado = DB::select('SELECT e.*, d.denominacion
                                  FROM emple e
                             LEFT JOIN depart d
                                    ON depart_id = d.id
                                 WHERE e.id = ?', [$id]); */

        abort_if($empleados->isEmpty(), 404);

        return $empleados->first();
    }
}
