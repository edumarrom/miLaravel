<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Depart;
use App\Models\Emple;

class DepartController extends Controller
{
    public function index()
    {
        $ordenes = ['denominacion', 'localidad'];
        $orden = request()->query('orden') ?: 'denominacion';
        abort_unless(in_array($orden, $ordenes), 404);

        $departs = Depart::orderBy($orden);

        /* $departs = DB::table('depart')
            ->orderBy($orden); */

        if (($denominacion = request()->query('denominacion')) !== null) {
            $departs->where('denominacion', 'ilike', "%$denominacion%");
        }

        if (($localidad = request()->query('localidad')) !== null) {
            $departs->where('localidad', 'ilike', "%$localidad%");
        }

        $paginador = $departs->paginate(4);
        $paginador->appends(compact(
            'orden',
            'denominacion',
            'localidad'
        ));

        return view('depart.index', [
            'departamentos' => $paginador,
        ]);
    }

    public function create()
    {

        $departamento = new Depart();

        /* $departamento = (object) [
            'denominacion' => null,
            'localidad' => null,
        ]; */

        return view('depart.create', [
            'departamento' => $departamento,
        ]);
    }

    public function store()
    {
        $validados = $this->validar();

        $departamento = new Depart($validados); // Asignación masiva

        /* $departamento->denominacion = $validados['denominacion'];
        $departamento->localidad = $validados['localidad']; */

        $departamento->save();

        /* DB::table('depart')
            ->insert([
                'denominacion' => $validados['denominacion'],
                'localidad' => $validados['localidad'],
        ]); */

        return redirect('/depart')
            ->with('success', 'Departamento insertado con éxito.');
    }

    public function edit($id)
    {
        $departamento = Depart::findOrFail($id);

        /* $departamento = $this->findDepartamento($id); */

        return view('depart.edit', [
            'departamento' => $departamento,
        ]);
    }

    public function update($id)
    {
        $validados = $this->validar();

        $departamento = Depart::findOrFail($id);

        /* $this->findDepartamento($id); */

        $departamento->fill([
            'denominacion' => $validados['denominacion'],
            'localidad' => $validados['localidad'],
        ]);

        $departamento->save();

        /* DB::table('depart')
            ->where('id', $id)
            ->update([
                'denominacion' => $validados['denominacion'],
                'localidad' => $validados['localidad'],
        ]); */

        return redirect('/depart')
            ->with('success', 'Departamento modificado con éxito.');

    }

    public function destroy($id)
    {
        $departamento = Depart::findOrFail($id);

        /* $this->findDepartamento($id);  // No es necesario que vuelque en una variable */

        if(Emple::where('depart_id', $departamento->id)->doesntExist()) {
            Depart::where('id', $id)->delete();
        } else {
            return redirect()->back()
            ->with('error', 'El departamento no está vacío.');
        }

        /* DB::table('depart')->where('id', $id)->delete(); */

        return redirect()->back()
            ->with('success', 'Departamento borrado correctamente');
    }

    /* private function findDepartamento($id)
    {
        $departamentos = DB::table('depart')
            ->where('id', $id)->get();

        abort_if($departamentos->isEmpty(), 404);

        return $departamentos->first();
    } */

    private function validar()
    {
        $validados = request()->validate([
            'denominacion' => 'required|max:255',
            'localidad' => 'required|max:255',
        ]);

        return $validados;
    }
}
