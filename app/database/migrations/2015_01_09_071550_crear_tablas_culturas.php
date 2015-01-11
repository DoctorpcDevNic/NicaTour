<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablasCulturas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fotocultura', function($table)
		{
		    $table->increments('id');
		    $table->integer('id_depto');
		    $table->integer('id_tipo');
		    $table->text('foto');		    
		    $table->timestamps();
		});

		Schema::create('descripcioncultura', function($table)
		{
		    $table->increments('id');
		    $table->integer('id_depto');
		    $table->integer('id_tipo');
		    $table->integer('id_foto');
		    $table->integer('id_idioma');
		    $table->text('nombre');
		    $table->text('descripcion');
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
