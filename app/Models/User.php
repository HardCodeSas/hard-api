<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  {
  use HasApiTokens, Notifiable;
  protected $table      = 'SYS00001';
  protected $fillable   = ['USRIDXXX', 'USRNOMXX', 'USRAPEXX', 'USRNICKX', 'USRPASSX', 'USRPASSE'];
  public $timestamps    = false;
  protected $primaryKey = 'USRIDXXX';
  public $incrementing  = false;
  protected $keyType    = 'string';

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

  public function getAuthPassword() {
    return $this->USRPASSX;
  }
}
