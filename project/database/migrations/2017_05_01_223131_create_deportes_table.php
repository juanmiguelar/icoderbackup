<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeportesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deportes', function(Blueprint $table) {
            $table->increments('id_deporte');
            $table->string('name')->default('Un-Named Deporte');
            $table->string('slug');
            $table->text('description');
            $table->string('nombre');
            $table->integer('numero_maximo_atletas');
            $table->string('tipo');
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
		Schema::drop('deportes');
	}

}
