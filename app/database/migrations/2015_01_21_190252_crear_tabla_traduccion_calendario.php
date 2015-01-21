<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTraduccionCalendario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('traduccioneventos', function($trad)
		{
		    $trad->increments('id');
		    $trad->integer('id_evento');
		    $trad->integer('id_idioma');
		    $trad->integer('id_depto');
		    $trad->string('municipio');
		    $trad->date('fecha');
		    $trad->string('nombre');
		    $trad->text('direccion');
		    $trad->timestamps();
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
