<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'plazos',
            function (Blueprint $table) {
                $table->id();
                $table->integer('plazo');
                $table->string('descripcion');
                $table->double('tasa_normal');
                $table->double('tasa_puntual');
                $table->foreignId('usuario_id');
                $table->timestamps();

                $table->foreign('usuario_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plazos');
    }
}
