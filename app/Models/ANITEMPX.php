<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ANITEMPX extends Model  {

  protected $table      = 'ANITEMPX';
  protected $fillable   = ['TEMPNOMX', 'ANIIDXXX', 'TEMPNOMX', 'TEMPQUAL', 'TEMPLNKC', 'TEMPLNKA', 'REGESTXX'];
  public $timestamps    = false;
  protected $primaryKey = 'TEMPIDXX';
  public $incrementing  = true;

  public function saveTemp ($oRequest) {
    $oANITEMPX = new ANITEMPX();
    $oANITEMPX->ANIIDXXX = $oRequest->input('ANIIDXXX');
    $oANITEMPX->TEMPNOMX = $oRequest->input('TEMPNOMX');
    $oANITEMPX->TEMPQUAL = $oRequest->input('TEMPQUAL');
    $oANITEMPX->TEMPLNKC = $oRequest->input('TEMPLNKC');
    $oANITEMPX->TEMPLNKA = $oRequest->input('TEMPLNKA');
    $oANITEMPX->REGESTXX = "ACTIVO";
    $oANITEMPX->save();
    return $oANITEMPX;
  }

  public function updateTemp ($oRequest, $nTEMPIDXX) {
    $oANITEMPX = new ANITEMPX();
    $oANITEMPX = $oANITEMPX->findOrFail($nTEMPIDXX, "TEMPIDXX");
    if ($oRequest->input('ANIIDXXX') != null) {
      $oANITEMPX->ANIIDXXX = $oRequest->input('ANIIDXXX');
    }
    if ($oRequest->input('TEMPNOMX') != null) {
      $oANITEMPX->TEMPNOMX = $oRequest->input('TEMPNOMX');
    }
    if ($oRequest->input('TEMPQUAL') != null) {
      $oANITEMPX->TEMPQUAL = $oRequest->input('TEMPQUAL');
    }
    if ($oRequest->input('TEMPLNKC') != null) {
      $oANITEMPX->TEMPLNKC = $oRequest->input('TEMPLNKC');
    }
    if ($oRequest->input('TEMPLNKA') != null) {
      $oANITEMPX->TEMPLNKA = $oRequest->input('TEMPLNKA');
    }
    if ($oRequest->input('REGESTXX') != null) {
      $oANITEMPX->REGESTXX = $oRequest->input('REGESTXX');
    }
    $oANITEMPX->save();
    return $oANITEMPX;
  }

}
