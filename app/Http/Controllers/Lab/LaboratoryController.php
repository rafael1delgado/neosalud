<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Epi\SuspectCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class LaboratoryController extends Controller
{
    //


    public function chagasIndex($tray)
    {
        $query = SuspectCase::orderBy('id', 'desc')->whereNotNull('sample_at');
        if ($tray === 'Pendientes de Recepción') {
            $query->whereNull('reception_at');
        } elseif ($tray === 'Pendientes de Resultado') {
            $query->whereNull('chagas_result_screening')->whereNotNull('reception_at');
        } elseif ($tray === 'Finalizadas') {
            $query->whereNotNull('chagas_result_screening')->whereNotNull('reception_at');
        }

        $suspectcases = $query->paginate(100);

        return view('labs.chagasindex', compact('suspectcases', 'tray'));
    }


    public function chagasReception(SuspectCase $suspectcase, Request $request)
    {


        $suspectcase->receptor_id = Auth::id();
        if ($request->reception_at) {
            $suspectcase->reception_at = $request->reception_at;
        } else {
            $suspectcase->reception_at = date('Y-m-d H:i:s');
        }
        //TODO código duro, debería ser dinámico. ¿otra tabla solo para los labotatorios u ocupar organizatión?
        $suspectcase->laboratory_id = 4;
        $suspectcase->save();

        session()->flash('success', 'Se ha recepcionada la muestra: '
            . $suspectcase->id . ' en laboratorio: Hospital Ernesto Torres Galdames ');
        return redirect()->back();
    }

    public function massReception(Request $request)
    {
        $casosSeleccionados = $request->input('casos_seleccionados', []);
        $receptorId = Auth::id();
        $receptionAt = date('Y-m-d H:i:s');

        foreach ($casosSeleccionados as $casoId) {
            $caso = SuspectCase::find($casoId);
            if ($caso) {
                $caso->receptor_id = $receptorId;
                $caso->reception_at = $receptionAt;
                $caso->laboratory_id = 4; // TODO: Obtén el laboratorio correcto dinámicamente
                $caso->save();
            }
        }

        $response = [
            'message' => 'Se han recepcionado las muestras seleccionadas.',
        ];

        return response()->json($response);
    }



    public function downloadFile($fileName)
    {

        return Storage::disk('gcs')->download($fileName);
    }
}
