<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salas extends Model
{
    use HasFactory;

    protected $table = 'salas';

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
        'numero_sala',
    ];

    public function agendamento() {
        return $this->hasMany(Agendamento::class, 'id_sala');
    }
}
