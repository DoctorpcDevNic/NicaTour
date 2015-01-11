<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRestaurantesHoteles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('RestaurantesHoteles', function($table)
		{
		    $table->increments('id');
		    $table->integer('id_tipo');
		    $table->integer('id_depto');
		    $table->integer('id_idioma');
		    $table->string('nombre');
		    $table->string('telefono');
		    $table->text('direccion');
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
