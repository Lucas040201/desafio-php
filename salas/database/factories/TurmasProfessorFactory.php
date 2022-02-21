<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TurmasProfessor;
use App\Models\Usuarios;
use App\Models\Turmas;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TurmasProfessor>
 */
class TurmasProfessorFactory extends Factory
{
    /* The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = TurmasProfessor::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_usuario' => Usuarios::all()->random()->id,
            'id_turma' =>  Turmas::all()->random()->id
        ];
    }
}
