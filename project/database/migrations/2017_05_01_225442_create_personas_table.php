<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->string('cedula_persona');
            $table->string('nombre1');
            $table->string('nombre2');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->date('fecha_nacimiento');
            $table->string('nacionalidad');
            $table->string('telefono');
            $table->string('direccion');
            $table->decimal('estatura');
            $table->decimal('peso');
            $table->string('tipo_sangre');
            $table->string('tipo');
            $table->string('email');
            $table->string('cedula_frente');
            $table->string('cedula_atras');
            $table->string('boleta_inscripcion');
            $table->boolean('active_flag');
            $table->integer('author_id')->unsigned()->default(0);
            $table->foreign('author_id')->references('id')->on('users');
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
		Schema::drop('personas');
	}

}
