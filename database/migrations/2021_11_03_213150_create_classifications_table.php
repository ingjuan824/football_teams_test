<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->bigIncrements('position')->comment('Posición actual del equipo');
            $table->unsignedBigInteger('team_id')->unique()->comment('Equipo relacionado a la posición');
            $table->integer('pj',)->default(0)->comment('Número de partidos jugados por el equipo');
            $table->integer('pg',)->default(0)->comment('Número de partidos ganados por el equipo');
            $table->integer('pp',)->default(0)->comment('Número de partidos perdidos por el equipo');
            $table->integer('pe',)->default(0)->comment('Número de partidos empatados por el equipo');
            $table->integer('goals',)->default(0)->comment('Número de goles del equipo');
            $table->integer('points',)->default(0)->comment('Puntos obtenidos por el equipo');
            $table->boolean('status')->default(true);
            $table->timestamps();

            //  $table->primary(['position']);

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
        Schema::dropIfExists('classifications');
    }
}
