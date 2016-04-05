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

<h1><span id="demo"></span></h1>
<h2>Último número:<span id="numero"></span></h2>


</div>


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

setInterval(loadDoc, 5000);

function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("demo").innerHTML = xhttp.responseText;
	 
	 if(ultimo != xhttp.responseText)
	 {
		location.reload();
	 }
	 else
	 {
		 console.log('sigue igual');
	 }
	 
	 
    }
  };
  xhttp.open("GET", "include/check.php", true);
  xhttp.send();
}


</script>


</body>
</html>