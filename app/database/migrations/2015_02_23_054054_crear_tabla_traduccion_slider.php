<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTraduccionSlider extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('traduccionslider', function($trad)
		{
		    $trad->increments('id');
		    $trad->integer('id_slide');
		    $trad->integer('id_idioma');
		    $trad->integer('id_depto');
		    $trad->string('titulo');
		    $trad->text('descripcion');
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
