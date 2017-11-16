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
    <title>Alta de Usuarios</title>
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
      <h2>Alta Usuarios</h2>
      <form class="form-horizontal" method="post" enctype="" action="altaUsuarios.php" onsubmit="return validar()">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Nombre:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="apellidos">Apellidos:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="apellidos" name="apellidos">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="usuario">Usuario:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="usuario" name="usuario">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="contrasena">Contraseña:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contrasena" name="contrasena">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="reset" class="btn btn-danger">Borrar</button>
              <button type="submit" name="btAlta" class="btn btn-primary">Alta</button>
            </div>
          </div>
      </form>
    </div>
    <?php
    if (isset($_POST["btAlta"])){
      if ($_POST["nombre"]=="" || $_POST["apellidos"]=="" || $_POST["usuario"]==""){
        $_SESSION["mensaje"] = "Debe completar los campos.";
        header('Location: altaUsuarios.php');
        exit;
      }
      //var_dump($_POST);
        $servername = "localhost";
        $username = "id3638789_root";
        $password = "toor2017";
        $dbname = "id3638789_ciudades";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO tbusuarios (nombre, apellidos, usuario, contrasena) VALUES (?, ?, ?, ?)");
            $stmt->execute(array($_POST["nombre"], $_POST["apellidos"], $_POST["usuario"], md5($_POST["contrasena"])));
            $_SESSION["mensaje"] = "Alta Creada Satisfactoriamente";
            header ('Location: altaUsuarios.php');
            exit;
        }

      catch(PDOException $e)
      {
        echo "Error: " . $e->getMessage();
      }

      $conn = null;
    }
    if (isset($_SESSION["mensaje"])){
      echo '<br>';
      echo '<div class="alert alert-info">
      <strong>Info! </strong>' . $_SESSION["mensaje"] .'</div>';
      unset($_SESSION["mensaje"]);
    }
    ?>
    <script src="js/validaruser.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  </body>
</html>
