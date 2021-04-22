<?php

    //CONECTAR A LA BASE DE DATOS
    include_once 'conexion.php';

    //NO PERMITIR ACCESO AL ARCHIVO LOCAL ALTA MÉDICO A TRAVÉS DE LA URL
    if(!isset($_POST['dni_usuario']) && !isset($_POST['nuevo_usuario']) && !isset($_POST['contrasena']) && !isset($_POST['contrasena2'])){
        header('Location:registro.php');
    }

    //CAPTURAR DATOS POR MÉTODO POST
    $dni = $_POST['dni_usuario'];
    $usuario_nuevo = $_POST['nuevo_usuario'];
    $contrasena_nueva = $_POST['contrasena'];
    $contrasena_nueva2 = $_POST['contrasena2'];

    //VERIFICAR SI DNI EXISTE EN LA BASE DE DATOS
    $buscar = 'SELECT * FROM usuario WHERE dni = ?';
    $sentencia_buscar = $pdo->prepare($buscar);
    $sentencia_buscar->execute(array($dni));
    $resultado = $sentencia_buscar->fetch();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Registración de usuario</title>
  </head>
  <body>

    <div class="container mt-3">
        
        <div class="row">
            
            <div class="col-md-4">

                <?php

                    if(!$resultado){
                        echo 'Su DNI no esta registrado en el sistema, debe presentarse en un consultorio';
                        echo '<br><a href="registro.php">Volver a registración</a>';
                        die();
                    }
                    //VERIFICAR QUE EL NOMBRE DE USUARIO ELEGIDO NO EXISTA EN LA BASE DE DATOS
                    $buscar_nombre = 'SELECT nombre_usuario FROM usuario WHERE nombre_usuario = ?';
                    $sentencia_nombre = $pdo->prepare($buscar_nombre);
                    $sentencia_nombre->execute(array($usuario_nuevo));
                    $resultado_nombre = $sentencia_nombre->fetch();

                    if($resultado_nombre){
                        echo 'El nombre de usuario ya existe en el sistema';
                        echo '<br><a href="registro.php">Volver a registración</a>';
                        die();
                    }

                    //HASH DE CONTRASEÑA
                    $contrasena_nueva = password_hash($contrasena_nueva, PASSWORD_DEFAULT);

                    //VERIFICAR CONTRASEÑA
                    if (password_verify($contrasena_nueva2, $contrasena_nueva)) {
                        echo '¡La contraseña es válida!<br>';
                        
                        //AGREGAR USUARIO Y CONTRASEÑA A LA BASE DATOS
                        $sql_editar = 'UPDATE usuario SET nombre_usuario=?, contrasena=? WHERE dni=?';
                        $sentencia_editar = $pdo->prepare($sql_editar);

                        if( $sentencia_editar->execute(array($usuario_nuevo, $contrasena_nueva, $dni)) ){
                            echo 'Agregado<br>';
                            echo '<br><a href="registro.php">Volver a registración</a>';
                        }
                        else{
                            echo 'Error<br>';
                        }

                        /*
                            Cerramos conexión de base de datos y sentencia
                        */
                        $sentencia_editar = null;
                        $pdo = null;

                        /*
                            Función de PHP
                        */
                        //header('location:index.php');

                    } else {
                        echo 'La contraseña no es válida.';
                        echo '<br><a href="registro.php">Volver a registración</a>';
                    }

                    /*
                        Cerramos conexión de base de datos y sentencia
                    */
                    $pdo = null;
                ?>

            </div>
            
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>