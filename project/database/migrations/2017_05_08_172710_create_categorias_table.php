<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorias', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('Un-Named Categoria');
            $table->string('slug');
            $table->text('description');
            $table->integer('id_categoria');
            $table->string('nombre');
            $table->integer('edad_inicio');
            $table->integer('edad_final');
            $table->integer('anno_inicio');
            $table->integer('anno_final');
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
		Schema::drop('categorias');
	}

}
