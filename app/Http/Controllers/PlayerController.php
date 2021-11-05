<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerStoreRequest;
use App\Models\Player;
use App\Models\Team;
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
          
            return back()->with('mensaje','Jugador creado con éxito.');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
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
            $teams = Team::get();
            $players = Player::select('players.*', 'tm.name as team_name')
            ->join('teams as tm', 'tm.id', '=', 'players.team_id')
            ->paginate($per_page);

            return view('players')->with("teams",$teams)
            ->with( "players", $players);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
}
