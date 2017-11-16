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
    <title>Alta Ciudades</title>
  </head>
	<body>
		<?php
			include 'dameCiudades.php';
			include 'menu.php';
      if (!isset($_SESSION["UsuarioValidado"])){
          	header('Location: accederUsuarios.php');
        	}
		?>
		<div class="container mt-3">
			<h2>Alta Ciudades</h2>
			<form method="post" action="adminCiudades.php">
				<div class="form-group">
					<label class="control-label col-sm-2" for="ciudad">Ciudad:</label>
					<div class="col-sm-10">
						<input type="text" name="ciudad"><br>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="descripcion">Descripción:</label>
					<div class="col-sm-10">
						<input type="text" name="descripcion"><br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10">
						<input class="btn btn-primary" type="submit" name="btAlta" value="ALTA">
					</div>
				</div>
			</form>
			<?php
			if (isset($_POST["btAlta"])){
				var_dump($_POST);
				$servername = "localhost";
        $username = "id3638789_root";
        $password = "toor2017";
        $dbname = "id3638789_ciudades";
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$stmt = $conn->prepare("Insert INTO tbciudades
					 (ciudad,descripcion) values (?, ?)");
					$stmt->execute(
						array($_POST["ciudad"],
							$_POST["descripcion"]
							)
						);
					$autonumerico = $conn->lastInsertId();
					return $autonumerico;
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				$conn = null;
			}
			?>
		</div>
		<script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>
