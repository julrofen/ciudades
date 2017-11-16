<?php
  session_start();
  if (isset($_SESSION["UsuarioValidado"])){
    //var_dump($_SESSION["UsuarioValidado"]);
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">CIUDADES</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
      <?php
        if (isset($_SESSION["UsuarioValidado"])){
          for ($contador=0;$contador<count($ListaCiudades);$contador++){
            if ($ListaCiudades[$contador]['activo']==1){
              echo '<li class="nav-item">';
                echo '<a class="nav-link" href="index.php?c=' . $ListaCiudades[$contador]['id'] . '">' . $ListaCiudades[$contador]['ciudad'] . '</a>';
              echo '</li>';
            }
          }
        }
      ?>
    </ul>
    <ul class="navbar-nav">
      <?php if(isset($_SESSION["UsuarioValidado"])) {  ?>
      <li class="nav-item"><a class="nav-link" href="adminCiudades.php">Alta Ciudades</a></li>
      <li class="nav-item"><a class="nav-link" href="adminImagenes.php">Alta Imagenes</a></li>
      <?php } ?>
      <?php if (!isset($_SESSION["UsuarioValidado"])){?>
      <li class="nav-item"><a class="nav-link" href="altaUsuarios.php"><span class="glyphicon glyphicon-user"></span> Alta Usuario</a></li>
      <?php } ?>
      <?php if (!isset($_SESSION["UsuarioValidado"])){?>
      <li class="nav-item"><a class="nav-link" href="accederUsuarios.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      <?php }else { ?>
      <li class="nav-item"><a class="nav-link" href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir <?php echo $_SESSION["UsuarioValidado"][0]['nombre']; ?></a></li>
      <?php }  ?>
    </ul>
    <form class="form-inline mr-derecha">
      <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>
