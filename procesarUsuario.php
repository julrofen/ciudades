<?php
        $nombre=$_POST["nombre"];
        $apellidos=$_POST["apellidos"];
        $usuario=$_POST["usuario"];
        $contrasena=$_POST["contrasena"];

        echo $nombre;
      	echo $apellidos;
      	echo $usuario;
      	echo $contrasena;

        $servername = "localhost";
        $username = "id3638789_root";
        $password = "toor2017";
        $dbname = "id3638789_ciudades";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tbusuarios (nombre, apellidos, usuario, contrasena) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array($nombre, $apellidos, $usuario, $contrasena));
            echo "Alta Creada Satisfactoriamente";
        }

        catch(PDOException $e)
        {
          echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;

?>
