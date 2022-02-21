<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TurmasProfessor;

class TurmasProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TurmasProfessor::factory()
        ->count(10)
        ->create();
    }
}
