<?php
$servicio = "https://servicios.bcn.gob.ni/Tc_Servicio/ServicioTC.asmx?WSDL"; //url del servicio
$parametros = array(); //parametros de la llamada

    $parametros['Dia'] = date('j');
    $parametros['Mes'] = date('n');
    $parametros['Ano'] = date('Y');
    $client = new SoapClient($servicio, $parametros);
    $result = $client->RecuperaTC_Dia($parametros); //llamamos al métdo que nos interesa con los parámetros
    $TasaDiaria = ($result->RecuperaTC_DiaResult);
	$TasaDiaria=round($TasaDiaria,2);
	
/*Conexion a la BD */
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

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc())
	    {
			$actualizar="UPDATE deptos SET dolar='".$TasaDiaria."' WHERE id=".$row["id"];
			if ($conn->query($actualizar) === TRUE) {
				$conteo++;					   
			}
			else {
			    echo "Error updating record: " . $conn->error;
			}        
	    }	    
	    echo $conteo." Registros actualizados";
	}
	
	else {
	    echo "0 results";
	}
	$conn->close();
	
	echo "\n";
    echo "Tipo de cambio del dia ".date('j')."/".date('n')."/".date('Y')." es de C$".$TasaDiaria;

?>
