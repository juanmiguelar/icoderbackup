<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdicionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edicions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('Un-Named Edicion');
            $table->string('slug');
            $table->text('description');
            $table->string('lugar');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->date('fecha_inscripcion');
            $table->date('fecha_fin_inscripcion');
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
		Schema::drop('edicions');
	}

}
