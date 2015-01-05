<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetalleclima extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalleclima', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_depto');
			$table->string('nombre');
			$table->string('temperatura');
			$table->string('icono');
			$table->string('altura');
			$table->string('humedad');
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
		//
	}

}
