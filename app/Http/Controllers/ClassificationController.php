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

            return response(
                [
                    'success' => true,
                    'messages' => ["Tabla de clasificación."],
                    'data' => $classfication
                ],
                HttpResponse::HTTP_OK
            );
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => [Util::throwExceptionMessage($e)],
                'data' => []
            ], HttpResponse::HTTP_BAD_REQUEST);
        }
    }
}
