<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;


class ANITEMPXRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules() {
    $mRules = [];

    switch ($this->getMethod()) {
    case "PUT":
      $mRules = [
        'ANIIDXXX' => [
          'sometimes',
          'integer',
          function ($attribute, $value, $fail) {
            // Verificar que el anime exista y esté activo
            $exists = DB::table('ANIMEXXX')
              ->where('ANIIDXXX', $value)
              ->where('REGESTXX', 'ACTIVO')
              ->exists();

            if (!$exists) {
              $fail('El anime seleccionado no es válido o no está activo.');
            }
          }
        ],
        'REGESTXX' => 'sometimes|in:ACTIVO,INACTIVO',
        'TEMPNOMX' => 'sometimes|string|max:255',
        'TEMPQUAL' => 'sometimes|numeric|between:0,5',
        'TEMPLNKC' => 'sometimes|string|max:255',
        'TEMPLNKA' => 'sometimes|string|max:255',
      ];
      break;
    default:
      $mRules = [
        'ANIIDXXX' => [
            'required',
            'integer',
            function ($attribute, $value, $fail) {
                // Verificar que el anime exista y esté activo
                $exists = DB::table('ANIMEXXX')
                    ->where('ANIIDXXX', $value)
                    ->where('REGESTXX', 'ACTIVO')
                    ->exists();

                if (!$exists) {
                    $fail('El anime seleccionado no es válido o no está activo.');
                }
            }
        ],
        'TEMPNOMX' => 'required|string|max:255',
        'TEMPQUAL' => 'required|numeric|between:0,5',
        'TEMPLNKC' => 'required|string|max:255',
        'TEMPLNKA' => 'required|string|max:255',
      ];

      break;
    }

    return $mRules;
  }

  public function messages() {
    return [
      'ANIIDXXX.required' => 'El id del anime es obligatoria.',

      'TEMPNOMX.required' => 'El nombre de la temporada es obligatoria.',
      'TEMPNOMX.string'   => 'El nombre de la temporada debe ser una cadena de texto.',
      'TEMPNOMX.max'      => 'El nombre de la temporada no debe exceder los 255 caracteres.',

      'TEMPQUAL.required' => 'La calificacion de la temporada es obligatoria.',
      'TEMPQUAL.numeric'  => 'La calificacion de la temporada debe ser un numero.',
      'TEMPQUAL.between'  => 'La calificacion de la temporada debe estar en un rango de 0 a 5.',

      'TEMPLNKC.required' => 'El link de Crunchyroll es obligatoria.',
      'TEMPLNKC.string'   => 'El link de Crunchyroll debe ser una cadena de texto.',
      'TEMPLNKC.max'      => 'El link de Crunchyroll no debe exceder los 255 caracteres.',

      'TEMPLNKA.required' => 'El link de AnimeFlv es obligatoria.',
      'TEMPLNKA.string'   => 'El link de AnimeFlv debe ser una cadena de texto.',
      'TEMPLNKA.max'      => 'El link de AnimeFlv no debe exceder los 255 caracteres.',
    ];
  }
}
