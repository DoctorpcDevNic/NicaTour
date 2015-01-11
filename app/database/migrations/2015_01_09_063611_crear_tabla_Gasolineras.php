<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGasolineras extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Gasolineras', function($table)
		{
		    $table->increments('id');
		    $table->integer('id_depto');
		    $table->string('nombre');
		    $table->string('latitud');
		    $table->string('longitud');
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
