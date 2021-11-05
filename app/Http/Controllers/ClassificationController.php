<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use App\Utils\Util;
use Exception;
use Illuminate\Support\Facades\DB;

class ClassificationController extends Controller
{
    /**
     * Funcion que permite obtener la tabla de clasificacion actualizads de los equipos de una division
     * @param $request['per_page'],Cantidad de registros por pagina
     */
    public function index()
    {
        try {

            $classfication = Classification::
            select('classifications.*', 'tm.name as team_name')
            ->join('teams as tm', 'tm.id', '=', 'classifications.team_id')
            ->orderBy('points','DESC')
            ->orderBy('goals','DESC')
            ->get();

            if (!$classfication) throw new Exception('Error : Lo sentimos no hay equipos registrados.');

            return view('classification')->with("classfication",$classfication);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
}
