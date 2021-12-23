<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'productos',
            function (Blueprint $table) {
                $table->id();
                $table->string('sku', 20)->unique();
                $table->string('descripcion');
                $table->double('precio');
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
        Schema::dropIfExists('productos');
    }
}
