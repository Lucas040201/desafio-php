<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turmas extends Model
{
    use HasFactory;

    protected $table = 'turmas';

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
        'turma',
    ];

    public function agendamento() {
        return $this->hasMany(Agendamento::class, 'id_turma');
    }
}
