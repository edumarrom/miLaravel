<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartController extends Controller
{
    public function index()
    {
        $departs = DB::table('depart')->get();

        return view('depart.index', [
            'departamentos' => $departs,
        ]);
    }

    public function create()
    {
        $departamento = (object) [
            'denominacion' => null,
            'localidad' => null,
        ];
        return view('depart.create', [
            'departamento' => $departamento,
        ]);
    }

    public function edit($id)
    {
        $departamento = $this->findDepartamento($id);

        return view('depart.edit', [
            'departamento' => $departamento,
        ]);
    }

    public function update($id)
    {
        $validados = $this->validar();
        $this->findDepartamento($id);

        DB::table('depart')
            ->where('id', $id)
            ->update([
                'denominacion' => $validados['denominacion'],
                'localidad' => $validados['localidad'],
        ]);

        return redirect('/depart')
            ->with('success', 'Departamento modificado con éxito.');

    }

    public function store()
    {
        $validados = $this->validar();

        DB::table('depart')
            ->insert([
                'denominacion' => $validados['denominacion'],
                'localidad' => $validados['localidad'],
        ]);

        return redirect('/depart')
            ->with('success', 'Departamento insertado con éxito.');
    }

    public function destroy($id)
    {
        $this->findDepartamento($id);  // No es necesario que vuelque en una variable

        DB::table('depart')->where('id', $id)->delete();

        return redirect()->back()
            ->with('success', 'Departamento borrado correctamente');
    }

    private function findDepartamento($id)
    {
        $departamentos = DB::table('depart')
            ->where('id', $id)->get();
/*         $departamento = DB::select('SELECT *
                                      FROM depart
                                     WHERE id = ?', [$id]); */

        abort_if($departamentos->isEmpty(), 404);

        return $departamentos->first();
    }

    private function validar()
    {
        $validados = request()->validate([
            'denominacion' => 'required|max:255',
            'localidad' => 'required|max:255',
        ]);

        return $validados;
    }
}
