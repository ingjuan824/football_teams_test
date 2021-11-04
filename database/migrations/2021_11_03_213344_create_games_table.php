<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('Fecha del partido');
            $table->integer('local_goals',)->comment('Número de goles del equipo local');
            $table->integer('away_goals',)->comment('Número de goles del equipo visitante');
            $table->unsignedBigInteger('local_team',)->comment('Id del equipo local');
            $table->unsignedBigInteger('away_team',)->comment('Id del equipo visitante');
            $table->boolean('status')->default(true);
            $table->timestamps();

                        // Agregamos las restricciones de clave externa
            // en los siguientes campos.
            $table->foreign('local_team')->references('id')->on('teams')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('away_team')->references('id')->on('teams')
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
        Schema::dropIfExists('games');
    }
}
