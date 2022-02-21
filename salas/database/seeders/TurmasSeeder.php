<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turmas;

class TurmasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turmas::factory()
        ->count(10)
        ->create();
    }
}
