<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTraduccionRestaurantesyhoteles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('RestaurantesHoteles', function($table)
		{
		    $table->dropColumn('id_idioma');
		});

		Schema::create('traduccionlocales', function($table)
		{
		    $table->increments('id');
		    $table->integer('id_tipo');
		    $table->integer('id_depto');
		    $table->integer('id_idioma');
		    $table->integer('id_local');
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
