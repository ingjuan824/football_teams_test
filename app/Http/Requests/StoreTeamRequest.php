<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;

class StoreTeamRequest extends FormRequest
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
            'division_id'  => 'required|numeric|integer|exists:divisions,id',
            'city_id'  => 'required|numeric|integer|exists:cities,id',
            'number_players'  => 'required|numeric|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del equipo es requerido.',
            'name.string' => 'El nombre del equipo no es valido.',

            'division_id.required' => 'La división del equipo es requerida.',
            'division_id.numeric' => 'La división del equipo no es válida.',
            'division_id.integer' => 'La división del equipo no es válida.',
            'division_id.exists' => 'La división especificada no existe.',

            'city_id.required' => 'La ciudad del equipo es requerida.',
            'city_id.numeric' => 'La ciudad del equipo no es válida.',
            'city_id.integer' => 'La ciudad del equipo no es válida.',
            'city_id.exists' => 'La ciudad especificada no existe.',

            'number_players.required' => 'El número de jugadores es requerido.',
            'number_players.numeric' => 'El número de jugadores no es válido.',
            'number_players.integer' => 'El número de jugadores no es válido.',
        ];
    }
    
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                "success" => false,
                "messages" => $validator->errors()->all(),
                "data" => [],
            ], 400
        ));
    }
}
