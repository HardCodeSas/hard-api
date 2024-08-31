<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\ANICATGX;
use Illuminate\Support\Facades\Storage;

class ANIMEXXX extends Model  {

  protected $table      = 'ANIMEXXX';
  protected $fillable   = ['ANIIDXXX', 'ANIDESXX', 'ANIPATHX', 'REGESTXX'];
  public $timestamps    = false;
  protected $primaryKey = 'ANIIDXXX';
  public $incrementing  = true;

  public function saveAnime ($oRequest) {
    $oANIMEXXX = new ANIMEXXX();
    $oANIMEXXX->ANIDESXX = $oRequest->input('ANIDESXX');
    $oANIMEXXX->REGESTXX = 'ACTIVO';
    $sFilePath = 'public/images/' . uniqid() . '.png';
    Storage::disk('local')->put($sFilePath, base64_decode($oRequest->input('FILEBS64')));
    $sUrl = Storage::disk('public')->url($sFilePath);
    $oANIMEXXX->ANIPATHX = $sUrl;
    $oANIMEXXX->save();

    // Guardo relacion categorias
    $oANICATGX = new ANICATGX();
    $oANICATGX = $oANICATGX->guardoRelacion($oANIMEXXX->ANIIDXXX, $oRequest->input('CATEGORX'));
    return $oANIMEXXX;
  }

  public function updateAnime ($oRequest, $nANIIDXXX) {

    $oANIMEXXX = new ANIMEXXX();
    $oANIMEXXX = $oANIMEXXX->findOrFail($nANIIDXXX, "ANIIDXXX");
    if ($oRequest->input('ANIDESXX') != null) {
      $oANIMEXXX->ANIDESXX = $oRequest->input('ANIDESXX');
    }
    if ($oRequest->input('REGESTXX') != null) {
      $oANIMEXXX->REGESTXX = $oRequest->input('REGESTXX');
    }
    if ($oRequest->input('FILEBS64') != null) {
      $sFilePath = 'public/images/' . uniqid() . '.png';
      Storage::disk('local')->put($sFilePath, base64_decode($oRequest->input('FILEBS64')));
      $sUrl = Storage::disk('public')->url($sFilePath);
      $oANIMEXXX->ANIPATHX = $sUrl;
    }
    if ($oRequest->input('CATEGORX') != null) {
      // Guardo relacion categorias
      $oANICATGX = new ANICATGX();
      $oANICATGX = $oANICATGX->guardoRelacion($oANIMEXXX->ANIIDXXX, $oRequest->input('CATEGORX'));
    }
    $oANIMEXXX->save();
    return $oANIMEXXX;
  }

}
