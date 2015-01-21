<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCalendario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Calendario', function($table)
		{
		    $table->increments('id');
		    $table->integer('id_depto');
		    $table->string('municipio');
		    $table->date('fecha');
		    $table->string('nombre');
		    $table->string('direccion');
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
