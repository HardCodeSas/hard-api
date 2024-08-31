<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ANICATGX extends Model  {

  protected $table      = 'ANICATGX';
  protected $fillable   = ['ANIIDXXX', 'CATIDXXX', 'REGESTXX'];
  public $timestamps    = false;
  protected $primaryKey = ['ANIIDXXX', 'CATIDXXX'];
  public $incrementing  = false;

  public function guardoRelacion($nANIIDXXX, $mCATIDXXX) {
    $aExistingRelations = DB::table('ANICATGX')
      ->where('ANIIDXXX', $nANIIDXXX)
      ->get();

    $aExistingCatIds = $aExistingRelations->pluck('CATIDXXX')->toArray();

    foreach ($mCATIDXXX as $sCATIDXXX) {
      if (in_array($sCATIDXXX, $aExistingCatIds)) {
        DB::table('ANICATGX')
          ->where('ANIIDXXX', $nANIIDXXX)
          ->where('CATIDXXX', $sCATIDXXX)
          ->update(['REGESTXX' => 'ACTIVO']);
      } else {
        DB::table('ANICATGX')->insert([
          'ANIIDXXX' => $nANIIDXXX,
          'CATIDXXX' => $sCATIDXXX,
          'REGESTXX' => 'ACTIVO'
        ]);
      }
    }

    $aCatIdsToInactivate = array_diff($aExistingCatIds, $mCATIDXXX);

    if (!empty($aCatIdsToInactivate)) {
      DB::table('ANICATGX')
        ->where('ANIIDXXX', $nANIIDXXX)
        ->whereIn('CATIDXXX', $aCatIdsToInactivate)
        ->update(['REGESTXX' => 'INACTIVO']);
    }
  }

}
