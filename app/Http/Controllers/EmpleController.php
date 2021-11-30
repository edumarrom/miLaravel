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
        $empleado = (object) [
            'nombre' => null,
            'fecha_alt' => null,
            'salario' => null,
            'depart_id' => null
        ];
        return view('emple.create', [
            'empleado' => $empleado,
        ]);
    }

    public function store()
    {
        $validados = $this->validar();

        DB::table('emple')
            ->insert([
                'nombre' => $validados['nombre'],
                'fecha_alt' => $validados['fecha_alt'],
                'salario' => $validados['salario'],
                'depart_id' => $validados['depart_id'],
        ]);

        return redirect('/emple')
            ->with('success', 'Empleado insertado con éxito.');
    }

    public function edit($id)
    {
        $empleado = $this->findEmpleado($id);

        return view('emple.edit', [
            'empleado' => $empleado,
        ]);
    }

    public function update($id)
    {
        $validados = $this->validar();
        $this->findEmpleado($id);

        DB::table('emple')
            ->where('id', $id)
            ->update([
                'nombre' => $validados['nombre'],
                'fecha_alt' => $validados['fecha_alt'],
                'salario' => $validados['salario'],
                'depart_id' => $validados['depart_id'],
        ]);

        return redirect('/emple')
            ->with('success', 'Empleado modificado con éxito.');

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

    private function validar()
    {
        $validados = request()->validate([
            'nombre' => 'required|max:255',
            'fecha_alt' => 'required|date',
        //  'salario' => 'required|min:0|max:9999.99',
            'salario' => 'required|numeric|between:0,9999.99',
        //  'salario' => 'required|regex:/^\d{0,4}(\.\d{1,2})?$/',
            'depart_id' => 'required|exists:depart,id',
        ]);

        return $validados;
    }
}
