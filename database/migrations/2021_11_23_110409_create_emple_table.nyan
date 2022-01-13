<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emple', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamp('fecha_alt');
            $table->decimal('salario', 6, 2);
            $table->timestamps();
            $table->unsignedInteger('depart_id');
            $table->foreign('depart_id')->references('id')->on('depart');

            /*
             * es poible resumir la FK constraint mediante:
             * $table->foreignId('depart_id')->constrained();
             * Pero dependiendo del caso puede que no funque,
             * y además prefiero la versión verbosa.
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emple');
    }
}
