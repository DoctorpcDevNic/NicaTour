<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablasParaEstadisticas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paginas', function($estat)
		{
		    $estat->increments('id');
		    $estat->string('tipo');
		    $estat->string('departamento');
		    $estat->timestamps();
		});
		Schema::create('contador', function($contad)
		{
		    $contad->increments('id');
		    $contad->integer('id_pag');
		    $contad->string('pais');
		    $contad->date('fecha');
		    $contad->timestamps();
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
