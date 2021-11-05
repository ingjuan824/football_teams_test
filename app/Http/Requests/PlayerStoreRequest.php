<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class PlayerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'name'  => 'required|string',
            'team_id'  => 'required|numeric|integer|exists:teams,id',
            'age'  => 'required|numeric|integer',
            'tr'  => 'required|numeric|integer',
            'ta'  => 'required|numeric|integer',
            'goals'  => 'required|numeric|integer',
            'pj'  => 'required|numeric|integer',
            'salary'  => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del equipo es requerido.',
            'name.string' => 'El nombre del equipo no es valido.',

            'team_id.required' => 'El equipo al cual pertenece el jugador es requerido.',
            'team_id.numeric' => 'El equipo al cual pertenece el jugador no es válido.',
            'team_id.integer' => 'El equipo al cual pertenece el jugador no es válido.',
            'team_id.exists' => 'El equipo al cual pertenece el jugador no existe.',

            'age.required' => 'La edad del jugador es requerida.',
            'age.numeric' => 'La edad del jugador no es válida.',
            'age.integer' => 'La edad del jugador no es válida.',

            'tr.required' => 'El número de tarjetas rojas del jugador es requerido.',
            'tr.numeric' => 'El número de tarjetas rojas del jugador no es válido.',
            'tr.integer' => 'El número de tarjetas rojas del jugador no es válido.',

            'ta.required' => 'El número de tarjetas amarillas del jugador es requerido.',
            'ta.numeric' => 'El número de tarjetas amarillas del jugador no es válido.',
            'ta.integer' => 'El número de tarjetas amarillas del jugador no es válido.',
            
            'goals.required' => 'El número de goles del jugador es requerido.',
            'goals.numeric' => 'El número de goles del jugador no es válido.',
            'goals.integer' => 'El número de goles del jugador no es válido.',
            
            'pj.required' => 'El número de partidos jugados por el jugador es requerido.',
            'pj.numeric' => 'El número de partidos jugados por el jugador no es válido.',
            'pj.integer' => 'El número de partidos jugados por el jugador no es válido.',

            'salary.required' => 'El sueldo del jugador es requerido.',
            'salary.numeric' => 'El sueldo del jugador no es válido.',
        ];
    }


}
