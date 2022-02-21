<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_professor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_turma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.v nnnnn 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turmas_professor');
    }
};
