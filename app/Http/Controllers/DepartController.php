<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartController extends Controller
{
    public function index()
    {
        $departs = DB::select('SELECT *
                                 FROM depart');
        return view('depart.index', [
            'departamentos' => $departs,
        ]);
    }

    public function create()
    {
        return view('depart.create');
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

        DB::update('UPDATE depart
                       SET denominacion = ?
                         , localidad = ?
                     WHERE id = ?', [
            $validados['denominacion'],
            $validados['localidad'],
            $id,
        ]);

        return redirect('/depart')
            ->with('success', 'El departamento modificado con éxito.');

    }

    public function store()
    {
        $validados = $this->validar();

        DB::insert('INSERT
                      INTO depart (denominacion, localidad)
                    values (?, ?)', [
            $validados['denominacion'],
            $validados['localidad'],
        ]);

        return redirect('/depart')
            ->with('success', 'Departamento insertado con éxito.');
    }

    public function destroy($id)
    {
        $this->findDepartamento($id);  // No es necesario que vuelque en una variable

        DB::delete('DELETE FROM depart
                          WHERE id = ?', [$id]);

        return redirect()->back()
            ->with('success', 'Departamento borrado correctamente');
    }

    private function findDepartamento($id)
    {
        $departamento = DB::select('SELECT *
                                      FROM depart
                                     WHERE id = ?', [$id]);

        abort_unless($departamento, 404);

        return $departamento[0];
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
