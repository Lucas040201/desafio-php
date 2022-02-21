<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuarios extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'usuarios';
    /**
     * Habilitando auto timestamp
     *
     */
    public $timestamps = true;

    /**
     * Atributos que podem ser atribuidos
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'sobrenome',
        'email',
        'senha',
    ];


    /**
     * Atributos que devem ser escondidos
     *
     * @var array
     */
    protected $hidden = [
        'senha',
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }


    public function agendamento() {
        return $this->hasMany(Agendamento::class, 'id_usuario');
    }

    public function turma() {
        return $this->hasMany(Turmas::class, 'id_usuario')->using(TurmasProfessor::class);
    }

}
