<?php
include_once('include/conf.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Llamamientos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">


<h1>Último número:<span id="numero"></span></h1>
<h2><span id="demo"></span></h2>


</div>



<!--sonido de llamada-->
<audio autoplay>
  <source src="audio/suspense.wav" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

<script>

<?php

$sql = "SELECT * FROM llamamiento ORDER BY tiempo DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
	$tiempo_ultimo = $row['tiempo'];
	$numero = $row['numero'];
} else {
    $tiempo_ultimo = 0;
}

?>

var ultimo = "<?php echo $tiempo_ultimo ?>";

document.getElementById("numero").innerHTML = "<?php echo $numero ?>";

//Ejecutamos la función de comprobación cada 5 segundos (5000 milisecs)
setInterval(loadDoc, 1000);

function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
		
     	console.log('Comprobado. Última llamada: ' + xhttp.responseText);
	 	//Comprobamos si la última llamada coincide con la que obtuvimos al cargar la página
		if(ultimo != xhttp.responseText)
		 {
			//Recargamos la página, al modificarse la base de datos
			location.reload();
		 }
		 else
		 {
			 //Calculamos el tiempo que ha pasado
			 var tiempo_actual = Math.floor(Date.now() / 1000);
			 var tiempo_pasado = tiempo_actual - ultimo;
			 console.log('sigue igual' + tiempo_pasado);
			 document.getElementById('demo').innerHTML = "Segundos transcurridos: " + tiempo_pasado;
		 }
	 
	 
    }
  };
  xhttp.open("GET", "include/check.php", true);
  xhttp.send();
}


</script>


</body>
</html>