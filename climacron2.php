<?php 

$servername = "50.87.200.51";
$username = "nicarah7_root";
$password = "N1c@tour";
$dbname = "nicarah7_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM infoclima";
$result = $conn->query($sql);
$conteo=0;

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc())
	    {
	        if($row["id_dpto"]>8)
	        {	
	        	  $json_string = file_get_contents($row["url"]);
				  $parsed_json = json_decode($json_string);
				  $location = $parsed_json->{'current_observation'}->{'display_location'}->{'city'};
				  $temp_c = $parsed_json->{'current_observation'}->{'temp_c'};
				  $icono = $parsed_json->{'current_observation'}->{'icon_url'};
				  $altura = $parsed_json->{'current_observation'}->{'observation_location'}->{'elevation'};
				  $humedad = $parsed_json->{'current_observation'}->{'relative_humidity'};
				  

				  $actualizar="UPDATE detalleclima SET temperatura='".$temp_c."', icono='".$icono."', humedad='".$humedad."' WHERE id_depto=".$row["id_dpto"];

				  if ($conn->query($actualizar) === TRUE) {
				  		$conteo++;					   
					} else {
					    echo "Error updating record: " . $conn->error;
					}

	        }	        
	    }	    
	    echo $conteo." Registros actualizados";
	}
	
	else {
	    echo "0 results";
	}
	$conn->close();
 ?>