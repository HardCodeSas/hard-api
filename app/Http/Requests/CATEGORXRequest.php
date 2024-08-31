<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CATEGORXRequest extends FormRequest {
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
          'CATDESCX' => 'sometimes|string|max:255',
          'REGESTXX' => 'sometimes|in:ACTIVO,INACTIVO',
        ];
        break;
      default:
        $mRules = [
          'CATDESCX' => 'required|string|max:255',
        ];
        break;
    }

    return $mRules;
  }


  public function messages() {
    return [
      'CATDESCX.required' => 'La descripción de la categoría es obligatoria.',
      'CATDESCX.string'   => 'La descripción de la categoría debe ser una cadena de texto.',
      'CATDESCX.max'      => 'La descripción de la categoría no debe exceder los 255 caracteres.',
    ];
  }
}
