<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TurmasProfessor extends Pivot
{
    use HasFactory;

    protected $table = 'turmas_professor';

    public $incrementing = true;

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
        'id_usuario',
        'id_turma'
    ];
}
