<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Tipo_Cambio extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'tipos_cambio';
     protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'valor',       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */ 
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */  
    public function productos()
    {
      return $this->hasMany('App\Models\Producto');
    }
}
