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
    <title>Ciudades</title>
  </head>
  <body>
    <?php
      include 'dameCiudades.php';
		  include 'menu.php';
      if(isset($_GET['c'])){
        include 'dameImagenes.php';
        if (!isset($_SESSION["UsuarioValidado"])){
          header('Location: accederUsuarios.php');
        }
      }
		?>

    <div class="container mt-3">
      <?php if(isset($_GET['c'])){
        // echo $_GET['c'];
        for ($contador=0;$contador<count($ListaCiudades);$contador++){
          if($ListaCiudades[$contador]['id']==$_GET['c'] && $ListaCiudades[$contador]['activo']==1){
            echo  '<div class="container mt-3">';
            echo  '<div class="alert alert-primary" role="alert">';
            echo  "<h2>".$ListaCiudades[$contador]['ciudad'] . "</h2>";
            echo  '</div>';
            echo  '</div>';
            echo  '<div class="container mt-3">';
            echo  '<div class="alert alert-light" role="alert">';
            echo  "<p>".$ListaCiudades[$contador]['descripcion']. "</p>";
            echo  '</div>';
            echo  '</div>';
            //var_dump($ListaImagenes);
            //echo count($ListaImagenes);
            echo  '<div class="container">';
            if (count($ListaImagenes)>0){
              for ($cont=0;$cont<count($ListaImagenes);$cont++){
                  echo "<img class='derecha' width='350' src='" . $ListaImagenes[$cont]['imagen'] . "'></img>";
              }
            }
            echo  '</div>';
          }
        }
      ?>
      <?php }else{
        if (isset($_SESSION["UsuarioValidado"])){
          echo  '<div class="container mt-3">';
          echo  '<div class="alert alert-info" role="alert">';
          echo  '<h2>Seleccione una Ciudad</h2>';
          echo  '</div>';
          echo  '<div class="alert alert-light" role="alert">';
          echo  '<h3>Pulsar en una Ciudad</h3>';
          echo  '</div>';
          echo  '</div>';
        }
        else{
          echo  '<div class="container mt-3">';
          echo  '<div class="alert alert-danger" role="alert">';
          echo  '<h2>Primero debe validarse</h2>';
          echo  '</div>';
          echo  '</div>';
          }
        } ?>
      </div>
    <script src="js/validar.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
