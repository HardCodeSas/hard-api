<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\CATEGORX;
use App\Models\ANIMEXXX;
use App\Models\ANITEMPX;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CATEGORXRequest;
use App\Http\Requests\ANIMEXXXRequest;
use App\Http\Requests\ANITEMPXRequest;
use App\Http\Resources\ANIMEXXXResource;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller {

  /**
   * Funciones para categorias de anime
   */
  public function createCategory(CATEGORXRequest $oRequest) {
    try {
      DB::beginTransaction();
      $oCATEGORX = new CATEGORX();
      $oCATEGORX->CATDESCX = $oRequest->input('CATDESCX');
      $oCATEGORX->REGESTXX = 'ACTIVO';
      $oCATEGORX->save();
      DB::commit();
      return response()->json(['data' => $oCATEGORX], 201);
    } catch (\Exception $oEx) {
      DB::rollBack();
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
    }
  }

  public function getCategory() {
    try {
      $oCATEGORX = new CATEGORX();
      $oCATEGORX = $oCATEGORX->where("REGESTXX", "ACTIVO")->get();
      return response()->json(['data' => $oCATEGORX], 200);
    } catch (\Exception $oEx) {
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
    }
  }

  public function updateCategory(CATEGORXRequest $oRequest, $nCATIDXXX) {
    try {
      DB::beginTransaction();
      $oCATEGORX = new CATEGORX();
      $oCATEGORX = $oCATEGORX->findOrFail($nCATIDXXX, "CATIDXXX");
      if ($oRequest->input('CATDESCX') != null) {
        $oCATEGORX->CATDESCX = $oRequest->input('CATDESCX');
      }
      if ($oRequest->input('REGESTXX') != null) {
        $oCATEGORX->REGESTXX = $oRequest->input('REGESTXX');
      }
      $oCATEGORX->save();
      DB::commit();
      return response()->json(['data' => $oCATEGORX], 201);
    } catch (\Exception $oEx) {
      DB::rollBack();
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
    }
  }

  /**
   * Funciones para crear la cabecera de los animes
   */

  public function createAnime(ANIMEXXXRequest $oRequest) {
    try {
      DB::beginTransaction();
      $oANIMEXXX = new ANIMEXXX();
      $oANIMEXXX = $oANIMEXXX->saveAnime($oRequest);
      DB::commit();
      return response()->json(['data' => $oANIMEXXX], 201);
  } catch (\Exception $oEx) {
      DB::rollBack();
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
  }
  }

  public function getAnime() {
    try {
      $oANIMEXXX = ANIMEXXX::where("REGESTXX", "ACTIVO")->get();
      return response()->json(['data' => ANIMEXXXResource::collection($oANIMEXXX)], 200);
    } catch (\Exception $oEx) {
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
    }
  }

  public function updateAnime(ANIMEXXXRequest $oRequest, $nANIIDXXX) {
    try {
      DB::beginTransaction();
      $oCATEGORX = new ANIMEXXX();
      $oCATEGORX = $oCATEGORX->updateAnime($oRequest, $nANIIDXXX);
      DB::commit();
      return response()->json(['data' => $oCATEGORX], 201);
    } catch (\Exception $oEx) {
      DB::rollBack();
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
    }
  }

  /**
   * Funciones para crear temporadas
   */

  public function createTemp(ANITEMPXRequest $oRequest) {
    try {
      DB::beginTransaction();
      $oANITEMPX = new ANITEMPX();
      $oANITEMPX = $oANITEMPX->saveTemp($oRequest);
      DB::commit();
      return response()->json(['data' => $oANITEMPX], 201);
    } catch (\Exception $oEx) {
      DB::rollBack();
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
    }
  }

  public function getTemp() {
    try {
      $oANITEMPX = ANITEMPX::where("REGESTXX", "ACTIVO")->get();
      return response()->json(['data' => $oANITEMPX], 200);
    } catch (\Exception $oEx) {
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
    }
  }

  public function updateTemp(ANITEMPXRequest $oRequest, $nTEMPIDXX) {
    try {
      DB::beginTransaction();
      $oANITEMPX = new ANITEMPX();
      $oANITEMPX = $oANITEMPX->updateTemp($oRequest, $nTEMPIDXX);
      DB::commit();
      return response()->json(['data' => $oANITEMPX], 201);
    } catch (\Exception $oEx) {
      DB::rollBack();
      Log::error('Error inesperado: ' . $oEx->getMessage());
      return response()->json(['Error' => 'Error ' . $oEx->getMessage()], 500);
    }
  }

}
