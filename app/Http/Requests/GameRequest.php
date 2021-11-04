<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class GameRequest extends FormRequest
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
            'local_team_id'  => 'required|numeric|integer|exists:teams,id',
            'away_team_id'  => 'required|numeric|integer|exists:teams,id',
            'local_goals'  => 'required|numeric|integer',
            'away_goals'  => 'required|numeric|integer',
        ];
    }

    public function messages()
    {
        return [

            'local_team_id.required' => 'El equipo local es requerido.',
            'local_team_id.numeric' => 'El equipo local no es válido.',
            'local_team_id.integer' => 'El equipo local no es válido.',
            'local_team_id.exists' => 'El equipo local no existe.',

            'away_team_id.required' => 'El equipo visitante es requerido.',
            'away_team_id.numeric' => 'El equipo visitante no es válido.',
            'away_team_id.integer' => 'El equipo visitante no es válido.',
            'away_team_id.exists' => 'El equipo visitante no existe.',

            'local_goals.required' => 'Los goles del equipo local son requeridos.',
            'local_goals.numeric' => 'Los goles del equipo local no son válidos.',
            'local_goals.integer' => 'Los goles del equipo local no son válidos.',

            'away_goals.required' => 'Los goles del equipo visitante son requeridos.',
            'away_goals.numeric' => 'Los goles del equipo visitante no son válidos.',
            'away_goals.integer' => 'Los goles del equipo visitante no son válidos.',

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
            response()->json(
                [
                    "success" => false,
                    "messages" => $validator->errors()->all(),
                    "data" => [],
                ],
                400
            )
        );
    }
}
