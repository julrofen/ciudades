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
			<form method='post' enctype="multipart/form-data" action='adminImagenes.php'>
				<select name="listaCiudades">
					<?php  for ($contador=0;$contador<count($ListaCiudades);$contador++){  ?>
					<option value="<?php echo $ListaCiudades[$contador]['id']; ?>">
					<?php	echo $ListaCiudades[$contador]['ciudad'];  ?>
					</option>
					<?php }  ?>
				</select>
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Alta" name="btAlta">
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

					$stmt = $conn->prepare("Insert INTO tbimagenes
					 (imagen,idciudad) values (?, ?)");
					$stmt->execute(
						array("",$_POST["listaCiudades"])
						);
					$autonumerico = $conn->lastInsertId();
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				$conn = null;


				$target_dir = "uploads/" . $autonumerico . "_" ;
				$target_file = $target_dir . $_FILES["fileToUpload"]["name"];
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);


				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$stmt = $conn->prepare("UPDATE tbimagenes SET imagen=? WHERE id=?");
					$stmt->execute(
						array($target_file,$autonumerico)
						);
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
				$conn = null;
			}
			?>
	</body>
</html>
