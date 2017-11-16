<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/estilos.css" type="text/css" />
    <title>Acceder Usuarios</title>
  </head>
  <body>
    <?php
  		include 'dameCiudades.php';
      include 'menu.php';
			if (isset($_SESSION["UsuarioValidado"])){
	        	header('Location: index.php');
	      	}
		?>
    <div class="container mt-3">
			<h2>Acceso Usuarios</h2>
			<form class="form-horizontal" method="post" enctype="" action="accederUsuarios.php" onsubmit="return validar()">
				<div class="input-group">
           <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
           <input id="usuario" type="text" class="form-control" name="usuario" placeholder="Usuario">
        </div>
        <br>
        <div class="input-group">
           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
           <input id="contrasena" type="password" class="form-control" name="contrasena" placeholder="Contraseña">
        </div>
        <br>
				<div class="input-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="btEntrar" class="btn btn-danger">ACCEDER</button>
						<button type="button" name="btAlta" class="btn btn-primary" onclick="location.href='altaUsuarios.php'">REGISTRARSE</button>
					</div>
				</div>
			</form>
		</div>
		<?php
			if (isset($_POST["btEntrar"])){
				//var_dump($_POST);
				$servername = "localhost";
        $username = "id3638789_root";
        $password = "toor2017";
        $dbname = "id3638789_ciudades";
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("select * from tbusuarios
						where usuario=? and contrasena=?");
					$stmt->execute(
						array($_POST["usuario"],
								md5($_POST["contrasena"])
						)
					);
					//$_SESSION["UsuarioValidado"]
					//header('Location: index.php');
					//exit;
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
            		$usuValidado=$stmt->fetchAll();
            		var_dump($usuValidado);
            		if (count($usuValidado)>0){
						$_SESSION["UsuarioValidado"]=$usuValidado;
						var_dump($_SESSION["UsuarioValidado"]);
						header('Location: index.php');
						exit;
					}else{
						$_SESSION["mensaje"] = "Usuario no encontrado.";
						header('Location: accederUsuarios.php');
						exit;
					}
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				$conn = null;
			}
			if (isset($_SESSION["mensaje"])){
        echo '<br>';
				echo '<div class="alert alert-danger">
				<strong>Attention! </strong>' . $_SESSION["mensaje"] .
				'</div>';
				unset($_SESSION["mensaje"]);
			}
		?>
    <script src="js/validar.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  </body>
</html>
