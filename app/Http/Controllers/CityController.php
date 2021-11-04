<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Exception;

class CityController extends Controller
{
    /**
     * Funcion que permite listar todas las divisiones registradas en el sistema
     * @param $request['per_page'],Cantidad de registros por pagina
     */
    public function index()
    {
        try {
            $per_page = \Request::get('per_page') ?: 10;

            $cities = City::paginate($per_page);
            if (!$cities) throw new Exception('Error : Lo sentimos no hay ciudades registradas.');

            return response(
                [
                    'success' => true,
                    'messages' => ["Listado de ciudades."],
                    'data' => $cities
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
