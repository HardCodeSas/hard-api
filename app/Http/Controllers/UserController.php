<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
  public function index() {
    $usuarios = User::all();
    return response()->json($usuarios);
  }

  public function store(Request $request) {
    $data = $request->all();

    $data['REGHORXX'] = now()->format('H:i:s');
    $data['REGFECXX'] = now()->format('Y-m-d');
    $data['REGSTAMP'] = now()->format('Y-m-d H:i:s');
    $data['REGESTXX'] = "ACTIVO";

    $usuario = User::create($data);
    return response()->json($usuario, 201);
  }


  public function show($id) {
    $usuario = User::findOrFail($id);
    return response()->json($usuario);
  }

  public function update(Request $request, $id) {
    $usuario = User::findOrFail($id);
    $data    = $request->all();
    $data['REGHORMX'] = now()->format('H:i:s');
    $data['REGFECMX'] = now()->format('Y-m-d');

    $usuario->update($data);
    return response()->json($usuario);
  }

  public function destroy($id) {
    User::destroy($id);
    return response()->json("Usuario eliminado", 204);
  }
}
