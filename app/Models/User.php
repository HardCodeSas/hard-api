<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
  protected $table      = 'usuarios';
  protected $fillable   = ['NOMBRE', 'APELLIDO', 'ESTADO'];
  protected $primaryKey = 'ID';
  public $timestamps    = false;

  const CREATED_AT = 'REGFECXX';
  const UPDATED_AT = 'REGFECMX';

  protected $casts = [
      'REGFECXX' => 'datetime:Y-m-d',
      'REGFECMX' => 'datetime:Y-m-d',
  ];

  protected static function boot() {
    parent::boot();

    static::creating(function ($model) {
      $now             = now();
      $model->REGHORXX = $now->format('H:i:s');
      $model->REGFECXX = $now->format('Y-m-d');
      $model->REGSTAMP = $now->format('Y-m-d H:i:s');
      $model->REGESTXX = 'ACTIVO';
      $model->REGFECMX = $now->format('Y-m-d');
      $model->REGHORMX = $now->format('H:i:s');
    });

    static::updating(function ($model) {
      $now             = now();
      $model->REGHORMX = $now->format('H:i:s');
      $model->REGFECMX = $now->format('Y-m-d');
    });
  }

}
