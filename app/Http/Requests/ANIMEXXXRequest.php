<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ANIMEXXXRequest extends FormRequest {
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
      case 'POST':
        $mRules = [
          'ANIDESXX' => 'required|string|max:255',
          'FILEBS64' => 'required|string',
          'CATEGORX' => 'required|array',
          'CATEGORX.*' => [
            'integer',
            function ($attribute, $value, $fail) {
              // Verificar que la categoría exista y esté activa
              $exists = DB::table('CATEGORX')
                ->where('CATIDXXX', $value)
                ->where('REGESTXX', 'ACTIVO')
                ->exists();

              if (!$exists) {
                $fail('La categoría seleccionada no es válida o no está activa.');
              }
            }
          ],
        ];
        break;
      case "PUT":
        $mRules = [
          'ANIDESXX' => 'sometimes|string|max:255',
          'FILEBS64' => 'sometimes|string',
          'REGESTXX' => 'sometimes|in:ACTIVO,INACTIVO',
          'CATEGORX' => 'sometimes|array',
          'CATEGORX.*' => [
            'integer',
            function ($attribute, $value, $fail) {
              // Verificar que la categoría exista y esté activa
              $exists = DB::table('CATEGORX')
                ->where('CATIDXXX', $value)
                ->where('REGESTXX', 'ACTIVO')
                ->exists();

              if (!$exists) {
                $fail('La categoría seleccionada no es válida o no está activa.');
              }
            }
          ],
        ];
        break;
      default:
        break;
    }

    return $mRules;
  }

  public function messages() {
    return [
        'ANIDESXX.required' => 'La descripción del anime es obligatoria.',
        'ANIDESXX.string' => 'La descripción del anime debe ser una cadena de texto.',
        'ANIDESXX.max' => 'La descripción del anime no debe exceder los 255 caracteres.',

        'FILEBS64.required' => 'El campo de la imagen es obligatorio.',
        'FILEBS64.string' => 'La imagen debe estar en formato de cadena base64.',

        'CATEGORX.required' => 'Debe seleccionar al menos una categoría.',
        'CATEGORX.array' => 'Las categorías deben enviarse como un array.',
        'CATEGORX.*.integer' => 'Cada ID de categoría debe ser un número entero.',
        'CATEGORX.*.exists' => 'La categoría seleccionada no es válida.',
    ];
  }

}
