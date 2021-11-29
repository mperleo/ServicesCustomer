<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/mdb.dark.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="stylesheet" href="css/mdb.rtl.min.css">
	<title>SOA Practica services consumer</title>
</head>
<body>

<nav class="navbar navbar-light bg-light nav-tabs border-bottom border-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php">Services Customer</a>
		<div  id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" aria-current="page" href="electrica.php">Datos de demanda eléctrica</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="junta.php">Analisis de datos de la junta</a>
			</li>
		</ul>
		</div>
	</div>
</nav>

<div class="container mt-5">

<form id="formulario" action="electrica.php" method="get">
<label for="start" class="form-label" class="form-label">Fecha de inicio:</label>
<input type="date" name="fechin" class="form-control">

<label for="start" class="form-label">Fecha final:</label>
<input type="date" id="start" name="fechfin" class="form-control">
<fieldset>
		<label for="comunidad" class="form-label">Seleccione la comunidad:</label>
		<select name="comunidad" class="form-select">
			<option value="5">Aragón</option>
			<option value="4">Andalucía</option>
			<option value="9">Cataluña</option>
			<option value="6">Cantabria</option>
			<option value="10">País Vasco</option>
			<option value="11">Principado de Asturias</option>
			<option value="8744">Comunidad de Ceuta</option>
			<option value="8745">Comunidad de Melilla</option>
			<option value="8">Castilla y León</option>
			<option value="13">Comunidad de Madrid</option>
			<option value="7">Castilla la Mancha</option>
			<option value="14">Comunidad de Navarra</option>
			<option value="15">Comunidad Valenciana</option>
			<option value="16">Extremadura</option>
			<option value="17">Galicia</option>
			<option value="8743">Islas Baleares</option>
			<option value="8742">Islas Canarias</option>
			<option value="20">La Rioja</option>qw	
			<option value="21">Region de Murcia</option>
		</select>
</fieldset>

<input type="submit" name="act" value="Realizar operación" class="form-control mt-3">

</form>

<?php
if(isset($_GET["act"]))
{
		$ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://apidatos.ree.es/es/datos/demanda/demanda-maxima-horaria?geo_limit=ccaa&geo_id=".$_GET["comunidad"]."&start_date=".$_GET["fechin"]."T00:00&end_date=".$_GET["fechfin"]."T22:00&time_trunc=month");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $response = curl_exec($ch);
		$datos1=json_decode($response, true);
		
		curl_setopt($ch, CURLOPT_URL, "https://apidatos.ree.es/es/datos/demanda/demanda-maxima-diaria?geo_limit=ccaa&geo_id=".$_GET["comunidad"]."&start_date=".$_GET["fechin"]."T00:00&end_date=".$_GET["fechfin"]."T22:00&time_trunc=month");
		$response = curl_exec($ch);
		$datos2=json_decode($response, true);
        curl_close($ch);
		
		//Maxima electrica diaria
		echo $datos2["included"][0]["attributes"]["title"].": ".$datos2["included"][0]["attributes"]["values"][0]["value"]."<br />";
		echo "Ultima actualización: ".$datos2["included"][0]["attributes"]["last-update"]."<br />";
		
		//Maxima horaria
		echo $datos1["included"][0]["attributes"]["title"].": ".$datos1["included"][0]["attributes"]["values"][0]["value"]."<br />";
		echo "Ultima actualización: ".$datos1["included"][0]["attributes"]["last-update"]."<br />";

}
?>
</body>
</html>