<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {

  public function index() {
    $oUsuarios = User::all();
    return response()->json($oUsuarios);
  }

  public function store(Request $oRequest) {
    try {
      $mData = $oRequest->all();
      $mData['USRPASSE'] = $mData['USRPASSX'];
      $mData['USRPASSX'] = Hash::make($mData['USRPASSX']);

      $mData['REGHORXX'] = now()->format('H:i:s');
      $mData['REGFECXX'] = now()->format('Y-m-d');
      $mData['REGSTAMP'] = now()->format('Y-m-d H:i:s');
      $mData['REGESTXX'] = "ACTIVO";

      $oResponse = User::create($mData);
      return response()->json($oResponse, 201);
    } catch (\Exception $e) {
      Log::error('Error inesperado: ' . $e->getMessage());
      return response()->json(['Error' => 'Error ' . $e->getMessage()], 500);
    }
  }

  public function show($sId) {
    $oResponse = User::findOrFail($sId);
    return response()->json($oResponse);
  }

  public function update(Request $oRequest, $sId) {
    try {
      $mUsuario = User::findOrFail($sId);
      $mData    = $oRequest->all();
      $mData['REGHORMX'] = now()->format('H:i:s');
      $mData['REGFECMX'] = now()->format('Y-m-d');

      $mUsuario->update($mData);

      return response()->json($mUsuario);
    } catch (\Exception $e) {
      Log::error('Error inesperado: ' . $e->getMessage());
      return response()->json(['Error' => 'Error ' . $e->getMessage()], 500);
    }
  }

  public function destroy($sId) {
    if (User::destroy($sId)) {
      return response()->json(['MESSAGE' => 'Se elimina el usuario con cedula: ' . $sId], 200);
    } else {
      return response()->json(['MESSAGE' => 'Error'], 200);
    }
  }

  public function login(Request $request) {
    $mCredentials = $request->validate([
      'USRIDXXX' => 'required|string',
      'USRPASSX' => 'required|string'
    ]);

    if (Auth::attempt(['USRIDXXX' => $mCredentials['USRIDXXX'], 'password' => $mCredentials['USRPASSX']])) {
      $user = Auth::user();
      $token = $user->createToken('API Token')->plainTextToken;

      return response()->json(['token' => $token, 'message' => 'Login successful']);
    }
    return response()->json(['message' => 'Unauthorized'], 401);
  }

}
