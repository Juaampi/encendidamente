<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Forma_Cara extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'formas_cara';
     protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',   
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

    public function receta()
    {
        return $this->belongsTo('App\Models\Receta', 'forma_id', 'id');
    }
}
