<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerStoreRequest;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use App\Utils\Util;
use Exception;

class PlayerController extends Controller
{
     /**
     * Funcion que permite crear un jugador que pertenece a un equipo.
     * @param $request, objeto con el [payload] proporcionados en la solicitud
     */
    public function store(PlayerStoreRequest $request)
    {
        try {
            /// Creamos el equipo
            $player = Player::create([
                'name' => $request->name,
                'team_id' => $request->team_id,
                'age' => $request->age,
                'tr' => $request->tr,
                'ta' => $request->ta,
                'goals' => $request->goals,
                'pj' => $request->pj,
                'salary' => $request->salary,
            ]);
          
            return response(
                [
                    'success' => true,
                    'messages' => ["Jugador creado con éxito."],
                    'data' => $player
                ],
                HttpResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return response([
                'success' => false,
                'message' => [Util::throwExceptionMessage($e)],
                'data' => []
            ], HttpResponse::HTTP_BAD_REQUEST);
        }
    }

        /**
     * Funcion que permite listar todos los jugddores registrados en el sistema
     * @param $request['per_page'],Cantidad de registros por pagina
     */
    public function index()
    {
        try {
            $per_page = \Request::get('per_page') ?: 10;

            $players = Player::select('players.*', 'tm.name as team_name')
            ->join('teams as tm', 'tm.id', '=', 'players.team_id')
            ->paginate($per_page);
            if (!$players) throw new Exception('Error : Lo sentimos no hay jugadores registrados.');

            return response(
                [
                    'success' => true,
                    'messages' => ["Listado de jugadores."],
                    'data' => $players
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
