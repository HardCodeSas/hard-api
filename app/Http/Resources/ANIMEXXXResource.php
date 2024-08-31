<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ANIMEXXXResource extends JsonResource {
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request) {
    // Obtener todas las relaciones desde ANICATGX
    $relations = DB::table('ANICATGX')
      ->join('CATEGORX', 'ANICATGX.CATIDXXX', '=', 'CATEGORX.CATIDXXX')
      ->where('ANICATGX.ANIIDXXX', $this->ANIIDXXX)
      ->where('ANICATGX.REGESTXX', 'ACTIVO')
      ->where('CATEGORX.REGESTXX', 'ACTIVO')
      ->select('ANICATGX.CATIDXXX', 'CATEGORX.CATDESCX')
      ->get();

    return [
        'ANIIDXXX' => $this->ANIIDXXX,
        'ANIDESXX' => $this->ANIDESXX,
        'ANIPATHX' => $this->ANIPATHX,
        'REGESTXX' => $this->REGESTXX,
        'ANICATGX' => $relations->toArray(),
    ];
  }
}
