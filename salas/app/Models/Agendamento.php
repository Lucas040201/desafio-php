<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $table = 'agendamento';

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
        'id_sala',
        'id_usuario',
        'id_turma',
        'data_agendamento',
        'horario_inicio',
        'horario_fim'
    ];

    // public function order()
	// {
	// 	return $this->belongsTo(Order::class, 'id_order');
	// }

    // public function product(){
    //     return $this->belongsTo(Product::class, 'id_product');
    // }
}
