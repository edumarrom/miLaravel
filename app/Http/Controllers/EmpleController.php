<?php

namespace App\Http\Controllers;

use App\Models\Emple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleController extends Controller
{
    public function index()
    {
        $ordenes = ['nombre', 'fecha_alt',
                    'salario', 'denominacion'];
        $orden = request()->query('orden') ?: 'nombre';
        abort_unless(in_array($orden, $ordenes), 404);

        $empleados = Emple::orderBy($orden);

        /* $empleados = DB::table('emple', 'e')
            ->leftJoin('depart AS d', 'depart_id', '=', 'd.id')
            ->select('e.*', 'denominacion')
            ->orderBy($orden); */

        if (($nombre = request()->query('nombre')) !== null) {
            $empleados->where('nombre', 'ilike', "%$nombre%");
        }

        if (($fecha_alt = request()->query('fecha_alt')) !== null) {
            $empleados->where('fecha_alt', 'ilike', "%$fecha_alt%");
        }

        if (($salario = request()->query('salario')) !== null) {
            $empleados->where('salario', '>=', "$salario");
        }

        if (($departamento = request()->query('departamento')) !== null) {
            $empleados->where('denominacion', 'ilike', "%$departamento%");
        }

        $paginador = $empleados->paginate(4);
        $paginador->appends(compact(
            'orden',
            'nombre',
            'fecha_alt',
            'salario',
            'departamento'
        ));

        return view('emple.index', [
            'empleados' => $paginador,
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
        $empleado = new Emple();

        return view('emple.create', [
            'empleado' => $empleado,
        ]);
    }

    public function store()
    {
        $validados = $this->validar();

        $empleado = new Emple($validados);

        /* DB::table('emple')
            ->insert([
                'nombre' => $validados['nombre'],
                'fecha_alt' => $validados['fecha_alt'],
                'salario' => $validados['salario'],
                'depart_id' => $validados['depart_id'],
        ]); */

        $empleado->save();

        return redirect('/emple')
            ->with('success', 'Empleado insertado con éxito.');
    }

    public function edit($id)
    {
        $empleado = Emple::findOrFail($id);

        return view('emple.edit', [
            'empleado' => $empleado,
        ]);
    }

    public function update($id)
    {
        $validados = $this->validar();
        $empleado = Emple::findOrFail($id);

        $empleado->fill([
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
