<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name',)->comment('Nombre del jugador');
            $table->unsignedBigInteger('team_id',)->comment('Equipo al cual pertenece el jugador');
            $table->integer('age',)->comment('Edad del jugador');
            $table->integer('tr',)->comment('Tarjetas rojas del jugador');
            $table->integer('ta',)->comment('Tarjetas amarillas del jugador');
            $table->integer('goals',)->comment('Número de goles del jugador');
            $table->integer('pj',)->comment('Número de partidos jugados por el jugador');
            $table->double('salary', 15, 2)->comment('Sueldo del jugador');
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Agregamos las restricciones de clave externa
            // en los siguientes campos.
            $table->foreign('team_id')->references('id')->on('teams')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
