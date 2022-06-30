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
        Schema::create('user_data', function (Blueprint $table) {

            $table->id();        
            
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento');
            $table->string('telefono');
            $table->string('eps')->nullable();
            $table->string('religion')->nullable();
            
            $table->integer('cant_personas_viven');
            $table->integer('cant_year_repetidos');
            $table->integer('cant_year_preescolar');
            $table->integer('cant_year_antes_preescolar');
            $table->integer('cant_hijos');
            $table->integer('cant_ant_disciplinarios');
            $table->integer('cant_hermanos');

            $table->string('caja_comp_familiar')->nullable();           
            $table->string('grupo_afro')->nullable();            
            $table->string('tabajo_actual')->nullable();
            
            $table->foreignId('genero_id')->nullable()->constrained('generos');
            $table->foreignId('tipo_sangre_id')->nullable()->constrained('tipo_sangres');
            $table->foreignId('tipo_vivienda_id')->nullable()->constrained('tipo_viviendas');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('user_data');
    }
};
