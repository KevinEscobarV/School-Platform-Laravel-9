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
        Schema::create('school_works', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('contenido');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->boolean('files')->default(true);
            $table->boolean('edit')->default(true);
            $table->unsignedBigInteger('tema_id');
            $table->foreign('tema_id')->references('id')->on('temas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_works');
    }
};
