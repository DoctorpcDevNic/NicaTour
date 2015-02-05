<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nicatourdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM deptos";
$result = $conn->query($sql);
$conteo=0;
$errores=0;

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc())
	    {
	        if($row["id"]>8)
	        {	
	        	  $json_string = file_get_contents($row["urlclima"]);
				  $parsed_json = json_decode($json_string);
				  $location = $parsed_json->{'current_observation'}->{'display_location'}->{'city'};
				  $temp_c = round($parsed_json->{'current_observation'}->{'temp_c'});
				  $icono = $parsed_json->{'current_observation'}->{'icon'};
				  $altura = $parsed_json->{'current_observation'}->{'observation_location'}->{'elevation'};
				  $humedad = $parsed_json->{'current_observation'}->{'relative_humidity'};
				  

				  $actualizar="UPDATE deptos SET municipio='".$location."', temperatura='".$temp_c."', icono='".$icono."', humedad='".$humedad."' WHERE id=".$row["id"];

				  if ($conn->query($actualizar) === TRUE) {
				  		$conteo++;
						echo "Datos climaticos de ".$row["nombre"]." actualizados correctamente \n";
					} else {
					    echo "Error updating record: " . $conn->error."\n";
						echo "Error al actualizar datos climaticos de ".$row["nombre"]." \n";
						$errores++;
					}

	        }	        
	    }	    
	    echo $conteo." Registros actualizados correctamente \n";
		echo $errores." Errores en total al actualizar registros \n";
	}
	
	else {
	    echo "0 results";
	}
	$conn->close();
 ?>