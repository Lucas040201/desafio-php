<?php

namespace Database\Factories;

use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsuariosFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuarios::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genero = $this->faker->randomElement(['male', 'female']);

        return [
            'nome' => $this->faker->firstName($genero),
            'sobrenome' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail,
            'senha' => Hash::make('123456'),
        ];
    }
}
