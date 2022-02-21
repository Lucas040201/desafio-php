<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salas;


class SalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salas::factory()
        ->count(10)
        ->create();
    }
}
