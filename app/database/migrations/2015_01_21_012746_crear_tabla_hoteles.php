<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaHoteles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hoteles', function($table)
		{
		    $table->increments('id');
		    $table->integer('id_depto');
		    $table->string('municipio');
		    $table->string('nombre');
		    $table->string('telefono');
		    $table->text('direccion');
		    $table->timestamps();
		});

		Schema::create('traduccionhoteles', function($trad)
		{
		    $trad->increments('id');
		    $trad->integer('id_hotel');
		    $trad->integer('id_idioma');
		    $trad->integer('id_depto');
		    $trad->string('municipio');
		    $trad->string('nombre');
		    $trad->string('telefono');
		    $trad->text('direccion');
		    $trad->timestamps();
		});

		Schema::create('traduccionrestaurantes', function($tradres)
		{
		    $tradres->increments('id');
		    $tradres->integer('id_rest');
		    $tradres->integer('id_idioma');
		    $tradres->integer('id_depto');
		    $tradres->string('municipio');
		    $tradres->string('nombre');
		    $tradres->string('telefono');
		    $tradres->text('direccion');
		    $tradres->timestamps();
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
