<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Clima1 extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:name';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Actualiza los datos climatologicos de los departamentos
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$Enlaces=DB::table('infoclima')
			->get();

		$Conteo=0;
		foreach ($Enlaces as $key) {
			if($key->id>=9)
			{
				$json_string = file_get_contents($key->url);
				$parsed_json = json_decode($json_string);
				$location = $parsed_json->{'current_observation'}->{'display_location'}->{'city'};
				$temp_c = $parsed_json->{'current_observation'}->{'temp_c'};
				$icono = $parsed_json->{'current_observation'}->{'icon_url'};
				$altura = $parsed_json->{'current_observation'}->{'observation_location'}->{'elevation'};
				$humedad = $parsed_json->{'current_observation'}->{'relative_humidity'};

				$DetalleClima = Clima::find($key->id);
				$DetalleClima->id_depto=$key->id_dpto;
				$DetalleClima->nombre=$location;
				$DetalleClima->temperatura=$temp_c;
				$DetalleClima->icono=$icono;
				$DetalleClima->altura=$altura;
				$DetalleClima->humedad=$humedad;

				if($DetalleClima->save()){
					$Conteo++;					
				}
			}
		}
		
		$this->info($Conteo.' Inserciones realizadas');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
