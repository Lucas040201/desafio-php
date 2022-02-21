<?php

namespace Database\Factories;

use App\Models\Salas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salas>
 */
class SalasFactory extends Factory
{
    /* The name of the factory's corresponding model.
    *
    * @var string
    */
   protected $model = Salas::class;
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
       return [
           'numero_sala' => $this->faker->unique()->numerify('##')
       ];
   }
}
