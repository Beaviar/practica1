<?php 
include_once('include/conf.php');
// Start the session
session_start();

if(isset($_GET['id_usuario']) && $_GET['id_usuario'] != '')
{
	$_SESSION['id_usuario'] = $_GET['id_usuario'];
}
if(isset($_GET['id_categoria']) && $_GET['id_categoria'] != '')
{
	$_SESSION['id_categoria'] = $_GET['id_categoria'];
}





?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Gestor de llamamientos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body >

<div class="container">


<?php if( !isset($_SESSION['id_usuario']) || !isset($_SESSION['id_categoria']) ) : ?> 
	<h1>Log in</h1>
	<div class="jumbotron">
    <form role="form" method="get" >
      <div class="form-group">
        <label for="id_usuario">Nombre:</label>
        <select class="form-control" id="id_usuario" name="id_usuario">
        	<option value="">Selecciona el usuario</option>
            
            
            <?php
			$sql = "SELECT * FROM usuarios ORDER BY nombre";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "<option value=" . $row["id_usuario"]. ">" . utf8_encode($row["nombre"]). "</option>";
				}
			} 
			
			?>
         
            
            
        </select>

      </div>
      <div class="form-group">
        <label for="id_categoria">Categoría:</label>
        <select class="form-control" id="id_categoria" name="id_categoria">
        	<option value="">Selecciona la categoría</option>
            
            
            <?php
			$sql = "SELECT * FROM categorias ORDER BY orden";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "<option value=" . $row["id_categoria"]. ">" . utf8_encode($row["nombre"]). "</option>";
				}
			} 
			
			?>

       
            
            
        </select>
      </div>

      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    </div>

 <?php else : ?>
 
 <h1>Adminsitración</h1>
 <h2>Usuario: <?php echo $_SESSION['id_usuario'] ?></h2>
 <h2>Categoría: <?php echo $_SESSION['id_categoria'] ?></h2>
 
 <h3><span id="demo"></span></h3>
 <script>
 
 setInterval(loadDoc,3000);
 
 function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "check.php", true);
  xhttp.send();
} 
</script>
 
 <?php endif ?>



</div>

</body>
</html>