<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Models\City;
use App\Models\Classification;
use App\Models\Division;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use App\Utils\Util;
use Exception;

class TeamController extends Controller
{
    /**
     * Funcion que permite crear un equipo de futbol.
     * @param $request, objeto con el [payload] proporcionados en la solicitud
     */
    public function store(StoreTeamRequest $request)
    {
        try {
            
            /// Creamos el equipo
            $team = Team::create([
                'name' => $request->name,
                'division_id' => $request->division_id,
                'city_id' => $request->city_id,
                'number_players' => $request->number_players,
            ]);

            /// Registramos  a el equipo en la tabla de posiciones 
            ///y automaticamente le asignamos la ultima posicion
            $end_position = Classification::latest('id')->first();
            Classification::create([
                'team_id' =>  $team->id,
                'position' =>  $end_position?  $end_position->id +1 :1
            ]);

            return back()->with('mensaje','Equipo creado con éxito.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
    /**
     * Funcion que permite listar todos los equipos registrados en el sistema
     * @param $request['per_page'],Cantidad de registros por pagina
     */
    public function index()
    {
        try {
            $per_page = \Request::get('per_page') ?: 10;

            $teams = Team::select('teams.*', 'ct.name as city_name', 'dv.name as division_name')
            ->join('cities as ct', 'ct.id', '=', 'teams.city_id')
            ->join('divisions as dv', 'dv.id', '=', 'teams.division_id')
            ->orderBy('id','asc')
            ->paginate($per_page);

            $divisions = Division::get();
            $cities = City::orderBy('name','ASC')->get();
           
            return view('football_teams')->with("teams",$teams)
            ->with( "divisions", $divisions)->with( "cities", $cities);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
}
