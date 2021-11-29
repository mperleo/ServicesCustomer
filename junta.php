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
		<div id="navbarNav">
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
<form id="formulario" action="junta.php" method="get">
<label for="fecha1" class="form-label" class="form-label">Fecha de inicio:</label>
<input name="fecha1" type="date" class="form-control">
<label for="fecha2" class="form-label">Fecha final:</label>
<input name="fecha2" type="date" class="form-control">

<label for="comunidad" class="form-label">Seleccione la comunidad:</label>
<select name="local" class="form-select">
	<option>Ávila</option>
	<option>Burgos</option>
	<option>León</option>
	<option>Palencia</option>
	<option>Salamanca</option>
	<option>Segovia</option>
	<option>Soria</option>
	<option>Valladolid</option>
	<option>Zamora</option>
</select>

<input type="submit" value="Comprobar" class="form-control mt-3">

<fieldset>
        <legend>Elija los datos que quieres comprobar:</legend>
        <input type="radio" name="op" value="recarga">Puntos de recarga de vehículos eléctricos<br/>
        <input type="radio" name="op" value="convocatoria">Convocatoria de empleo público<br/>
        <input type="radio" name="op" value="farmaceuticos">Establecimientos farmacéuticos en Castilla y León<br/>
		<input type="radio" name="op" value="covid">Tasa de mortalidad COVID-19 por zonas de salud<br/>
      </fieldset>
</form>

<?php

function quitar_tildes($cadena) {
$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
$texto = str_replace($no_permitidas, $permitidas ,$cadena);
return $texto;
}

error_reporting(0);
	$op=$_GET["op"];
	$local=$_GET["local"];
		if($op=="recarga"){
			$handle = curl_init("https://analisis.datosabiertos.jcyl.es/api/records/1.0/search/?dataset=puntos-de-recarga-del-vehiculo-electrico&q=&rows=150");
			 curl_setopt($handle, CURLOPT_POST, false);
			 //curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($todos));
			 curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			 $response=curl_exec($handle);
			 curl_close($handle);
			 
			 $result=json_decode($response, true);
			 
			$resultado=0;
			//var_dump($result["records"]);
			?>
			<table border="2px">

				  <tr>
					<th>Nombre del Organismo</th>
					<th>Calle</th>
					<th>CodigoPostal</th>
					<th>Localidad</th>
					<th>UltimaActualizacion</th>
					<th>Enlace al contenido</th>
					<th>Datos Personales</th>
				  </tr>
				
			<?php
			foreach($result["records"] as $resultado){
			 if(strtoupper(quitar_tildes($resultado["fields"]["localidad"]))==strtoupper(quitar_tildes($local))){
			?>
				
			
				  <tr>
					<td><?= $resultado["fields"]["nombre_del_organismo"]?></td>
					<td><?=$resultado["fields"]["calle"]?></td>
					<td><?=$resultado["fields"]["codigopostal"]?></td>
					<td><?=$resultado["fields"]["localidad"]?></td>
					<td><?=$resultado["fields"]["ultimaactualizacion"]?></td>
					<td><?=$resultado["fields"]["enlace_al_contenido"]?></td>
					<td><?= $resultado["fields"]["datospersonales"]?></td>
				  </tr>

				
				
			 <?php
			 //var_dump($resultado["fields"]);
			 }
			 
			}
			?></table>
			
		<?php
		}
		if($op=="convocatoria"){
			$handle = curl_init("https://analisis.datosabiertos.jcyl.es/api/records/1.0/search/?dataset=convocatorias-de-empleo-publico&q=&rows=1000");
			 curl_setopt($handle, CURLOPT_POST, false);
			 //curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($todos));
			 curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			 $response=curl_exec($handle);
			 curl_close($handle);
			 
			 $result=json_decode($response, true);
			 
			$resultado=0;
			
			//var_dump($result["records"][0]["fields"]);
		?>
			<table border="2px">

				  <tr>
					<th>Titulo</th>
					<th>Clasificador</th>
					<th>Tipo</th>
					<th>Organismo Gestor</th>
					<th>Numero Plazas</th>
					<th>Tasas</th>
					<th>Fecha de inicio</th>
					<th>Fecha de finalización</th>
					<th>Enlace al contenido</th>
					<th>Municipio</th>
				  </tr>
				
			<?php
			foreach($result["records"] as $resultado){
			
			if($resultado["fields"]["fecha_de_inicio"]>=$_GET["fecha1"] && $resultado["fields"]["fechafinalizacion"]<=$_GET["fecha2"]){
			 if($resultado["fields"]["municipio"]==$local){
			?>
				
			
				  <tr>
					<td><?=$resultado["fields"]["titulo"]?></td>
					<td><?=$resultado["fields"]["clasificador"]?></td>
					<td><?=$resultado["fields"]["tipo"]?></td>
					<td><?=$resultado["fields"]["organismo_gestor"]?></td>
					<td><?=$resultado["fields"]["numeroplazas"]?></td>
					<td><?=$resultado["fields"]["tasas"]?></td>
					<td><?=$resultado["fields"]["fecha_de_inicio"]?></td>
					<td><?=$resultado["fields"]["fechafinalizacion"]?></td>
					<td><?=$resultado["fields"]["enlace_al_contenido"]?></td>
					<td><?=$resultado["fields"]["municipio"]?></td>
				  </tr>
			
			<?php
			 }
			 
			}
			}
			?></table>
			
		<?php
		}
		
		if($op=="farmaceuticos"){
			$handle = curl_init("https://analisis.datosabiertos.jcyl.es/api/records/1.0/search/?dataset=registro-de-establecimientos-farmaceuticos-de-castilla-y-leon&q=&rows=500");
			 curl_setopt($handle, CURLOPT_POST, false);
			 //curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($todos));
			 curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			 $response=curl_exec($handle);
			 curl_close($handle);
			 
			 $result=json_decode($response, true);
			 
			$resultado=0;
			//var_dump($result["records"]);
			?>
			<table border="2px">

				  <tr>
					<th>Numero del registro</th>
					<th>Nombre comercial</th>
					<th>Teléfono</th>
					<th>Calle</th>
					<th>Localidad</th>
					<th>Municipio</th>
					<th>Codigo postal</th>
					<th>Número</th>
				  </tr>
				
			<?php
			foreach($result["records"] as $resultado){
			 if($resultado["fields"]["provincia"]==strtoupper(quitar_tildes($local))){
			?>
						
				  <tr>
					<td><?=$resultado["fields"]["num_reg"]?></td>
					<td><?=$resultado["fields"]["nombre_comercial"]?></td>
					<td><?=$resultado["fields"]["telefono"]?></td>
					<td><?=$resultado["fields"]["calle"]?></td>
					<td><?=$resultado["fields"]["localidad"]?></td>
					<td><?=$resultado["fields"]["municipio"]?></td>
					<td><?=$resultado["fields"]["codigo_postal"]?></td>
					<td><?= $resultado["fields"]["numero"]?></td>
				  </tr>

				
				
			 <?php
			 //var_dump($resultado["fields"]);
			 }
			 
			}
			?></table>
			
		<?php
		}
		
		if($op=="covid"){
			$handle = curl_init("https://analisis.datosabiertos.jcyl.es/api/records/1.0/search/?dataset=tasa-mortalidad-covid-por-zonas-basicas-de-salud&q=&rows=10000");
			 curl_setopt($handle, CURLOPT_POST, false);
			 //curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($todos));
			 curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			 $response=curl_exec($handle);
			 curl_close($handle);
			 
			 $result=json_decode($response, true);
			 
			$resultado=0;
			
			//var_dump($result["records"][0]["fields"]);
		?>
			<table border="2px">

				  <tr>
					<th>Fecha</th>
					<th>Nombre de Gerencia</th>
					<th>Centro</th>
					<th>Fallecidos</th>
					<th>Localización</th>
					<th>Provincia</th>
					<th>Municipio</th>
				  </tr>
				
			<?php
			foreach($result["records"] as $resultado){
			
			if($resultado["fields"]["fecha"]>=$_GET["fecha1"] && $resultado["fields"]["fecha"]<=$_GET["fecha2"]){
			 if($resultado["fields"]["provincia"]==$local){
			?>			
				  <tr>
					<td><?=$resultado["fields"]["fecha"]?></td>
					<td><?=$resultado["fields"]["nombregerencia"]?></td>
					<td><?=$resultado["fields"]["centro"]?></td>
					<td><?=$resultado["fields"]["fallecidos"]?></td>
					<td><?=$resultado["fields"]["zbs_geo"]?></td>
					<td><?=$resultado["fields"]["provincia"]?></td>
					<td><?=$resultado["fields"]["municipio"]?></td>
				  </tr>
			
			<?php
			 }
			 
			}
			}
			?></table>
			
		<?php
		}

?>
