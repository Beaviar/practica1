<?php
include_once('conf.php');

$sql = "SELECT * FROM llamamiento ORDER BY tiempo DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
	$tiempo_ultimo = $row['tiempo'];
} else {
    $tiempo_ultimo = 0;
}

echo $tiempo_ultimo;
?>