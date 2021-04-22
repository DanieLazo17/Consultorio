<?php
    //CONECTAR A LA BASE DE DATOS
    include_once 'conexion.php';

    /*
        Iniciar una nueva sesión o reanudar la existente
    */
    session_start();

    //VERIFICAR SI UN USUARIO ADMINISTRACIÓN INICIO SESIÓN
    if( isset($_SESSION['usuario'])){
        //echo 'Bienvenido '. $_SESSION['usuario'];
        //echo '<br><a href="cerrar.php">Cerrar Sesión</a>';
    }
    else{
        header('Location:formulario.php');
    }

    //LEER DE LA TABLA USUARIO SOLO EL REGISTRO DEL USUARIO ACTUAL PARA OBTENER SU DNI
    $usuario_actual = $_SESSION['usuario'];

    $sql_unica = 'SELECT * FROM usuario WHERE nombre_usuario=?';
    $sentencia_unica = $pdo->prepare($sql_unica);
    $sentencia_unica->execute(array($usuario_actual));
    $resultado_unico = $sentencia_unica->fetch();

    //VERIFICAR SI ALGÚN USUARIO SIN PERMISO DESEA ACCEDER
    if( !($resultado_unico['ID_PERMISO'] == "ADMIN")){
        header('Location:formulario.php');
    }

    $sentencia_unica = null;


    //NO PERMITIR ACCESO AL ARCHIVO LOCAL ASIGNACIÓN A TRAVÉS DE LA URL
    if(!isset($_POST['dni_pac']) && !isset($_POST['nombre_pac']) && !isset($_POST['obra_social_pac']) && !isset($_POST['nombre_med']) ){
        header('Location:administracion.php?campo=asignar_medico');
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Asignación de médico</title>
  </head>
  <body>

    <div class="container mt-3">
        
        <div class="row">
            
            <div class="col-md-4">

                <?php

                    //CAPTURAMOS DATOS DEL MÉDICO A TRAVÉS DEL MÉTODO POST
                    $dni_pac = $_POST['dni_pac'];
                    $nombre_pac = $_POST['nombre_pac'];
                    $obra_social_pac = $_POST['obra_social_pac'];

                    $nombre_med = $_POST['nombre_med'];

                    //var_dump($dni_nuevo);
                    //var_dump($permiso);

                    //BUSCAR DNI EN LA TABLA MÉDICO
                    $sql_medico = 'SELECT DNI FROM medico WHERE nombre=?';
                    $sentencia_medico = $pdo->prepare($sql_medico);
                    $sentencia_medico->execute(array($nombre_med));
                    $resultado_medico = $sentencia_medico->fetch();

                    /*
                        Cerramos conexión de base de datos y sentencia
                    */
                    $sentencia_medico = null;

                    //var_dump($resultado_medico['DNI']);

                    if(!$resultado_medico){
                        echo "No se encuentran datos";
                        echo '<br><a href="administracion.php">Volver al menú</a>';
                        die();
                    }

                    //AGREGAR A LA TABLA MED PAC LOS DOCUMENTOS DEL MÉDICO Y PACIENTE
                    $sql_guardar = 'INSERT INTO med_pac (DNI_MED, DNI_PAC) VALUES (?,?)';
                    $sentencia_guardar = $pdo->prepare($sql_guardar);

                    if( $sentencia_guardar->execute(array($resultado_medico['DNI'], $dni_pac)) ){
                        echo 'Asignación correcta<br>';
                        echo '<br><a href="administracion.php">Volver al menú</a>';
                    }
                    else{
                        echo 'Error<br>';
                    }

                    /*
                        Cerramos conexión de base de datos y sentencia
                    */
                    $sentencia_guardar = null;
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