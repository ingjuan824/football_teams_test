<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Exception;

class DivisionController extends Controller
{
    /**
     * Funcion que permite listar todas las divisiones registradas en el sistema
     * @param $request['per_page'],Cantidad de registros por pagina
     */
    public function index()
    {
        try {
            $per_page = \Request::get('per_page') ?: 10;

            $division = Division::paginate($per_page);
            if (!$division) throw new Exception('Error : Lo sentimos no hay divisiones registradas.');

            return response(
                [
                    'success' => true,
                    'messages' => ["Listado de divisiones."],
                    'data' => $division
                ],
                HttpResponse::HTTP_OK
            );
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => [Util::throwExceptionMessage($e)],
                'data' => []
            ], HttpResponse::HTTP_OK);
        }
    }
}
