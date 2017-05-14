<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provincias', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('Un-Named Provincium');
            $table->string('slug');
            $table->text('description');
            $table->string('nombre');
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
		Schema::drop('provincias');
	}

}
