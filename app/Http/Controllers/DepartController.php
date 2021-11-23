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

    public function destroy($id)
    {
        $departamento = $this->findDepartamento($id);

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
}
