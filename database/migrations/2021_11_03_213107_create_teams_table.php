<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name',)->comment('Nombre del equipo');
            $table->unsignedBigInteger('division_id',)->comment('División a la que pertenece el equipo');
            $table->unsignedBigInteger('city_id',)->comment('Ciudad a la que pertenece el equipo');
            $table->integer('number_players',)->comment('Número de jugadores del equipo');
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Agregamos las restricciones de clave externa
            // en los siguientes campos.
            $table->foreign('division_id')->references('id')->on('divisions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('city_id')->references('id')->on('cities')
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
        Schema::dropIfExists('teams');
    }
}
