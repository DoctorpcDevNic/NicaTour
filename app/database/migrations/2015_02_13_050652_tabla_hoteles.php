<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaHoteles extends Migration {

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
		    $table->string('tipo');
		    $table->string('categoria');
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
