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


    //NO PERMITIR ACCESO AL ARCHIVO LOCAL AGREGAR TURNO A TRAVÉS DE LA URL
    if( !isset($_POST['dni_pac']) && !isset($_POST['dni_med']) && !isset($_POST['fecha_turno']) && !isset($_POST['horario_turno'])){
        header('Location:administracion.php?campo=agregar_turno');
    }

    //CAPTURAR DATOS A TRAVÉS DEL MÉTODO POST
    $dni_pac = $_POST['dni_pac'];
    $dni_med = $_POST['dni_med'];
    $fecha_turno = $_POST['fecha_turno'];
    $horario_turno = $_POST['horario_turno'];

    //VERIFICAR QUE LA FECHA Y HORA INGRESADA ESTE LIBRE
    $sql_busqueda = 'SELECT * FROM turno WHERE DNI_MED=?  AND FECHA=? AND HORARIO=?';
    $sentencia_busqueda = $pdo->prepare($sql_busqueda);
    $sentencia_busqueda->execute(array($dni_med, $fecha_turno, $horario_turno));
    $resultado_busqueda = $sentencia_busqueda->fetch();

    /*
        Cerramos conexión de base de datos y sentencia
    */
    $sentencia_busqueda = null;

    //var_dump($resultado_busqueda);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

    <title>Datos protegidos</title>
  </head>
  <body>

    <!-- Titulo -->
    <div class="container mt-4">

        <div class="row">

            <div class="col-md-10">

                <?php
                    if( $resultado_busqueda ){
                        echo 'Fecha y horario no diponibles';
                        echo '<br><a href="administracion.php">Volver a menú principal</a>';
                        die();
                    }
                
                    /*
                        IMPORTANTE
                    */
                    /*
                    if( isset($resultado_busqueda) ){
                        echo 'Fecha y horario no diponibles';
                        echo '<br><a href="turno.php">Volver</a>';
                        die();
                    }
                    */
                
                    //GUARDAR DATOS EN LA TABLA TURNO
                    $sql_turno = 'INSERT INTO turno (FECHA, HORARIO, DNI_PAC, DNI_MED) VALUES (?,?,?,?)';
                    $sentencia_turno = $pdo->prepare($sql_turno);
                
                    if( $sentencia_turno->execute(array($fecha_turno, $horario_turno, $dni_pac, $dni_med)) ){
                        //echo 'Turno agregado';
                        //echo '<br><a href="administracion.php">Volver a menú principal</a>';
                    }
                    else{
                        echo 'Error<br>';
                    }
                    /*
                        Cerramos conexión de base de datos y sentencia
                    */
                    $sentencia_turno = null;
                
                    //VERIFICAR DATOS DE NUEVO TURNO
                    $sql_nturno = 'SELECT * FROM vw_turno WHERE DNI_PACIENTE=? AND NUMERO=(SELECT MAX(NUMERO) FROM vw_turno)';
                    $sentencia_nturno = $pdo->prepare($sql_nturno);
                    $sentencia_nturno->execute(array($dni_pac));
                    $resultado_nturno = $sentencia_nturno->fetchAll();
                
                    /*
                        Cerramos conexión de base de datos y sentencia
                    */
                    $sentencia_nturno = null;
                    $pdo = null;
                    
                ?>

                <h1>Datos protegidos</h1>
            
            </div>

            <div class="col-md-2">

                <?php
                    if( isset($_SESSION['usuario'])){
                        echo 'Bienvenida '. $_SESSION['usuario'];
                        echo '<br><a href="cuenta_admin.php">Mi cuenta</a>';
                        echo '<br><a href="administracion.php">Mi tarea</a>';
                        echo '<br><a href="cerrar.php">Cerrar sesión</a>';
                    }
                ?>
            
            </div>

        </div>
    
    </div>

    <div class="container mt-4 mb-4">

        <div class="row">

            <div class="col-md-12">
                <h4>Verificar datos</h2>
                <hr>
            </div>
            
            <div class="col-md-6 mt-3">
                <h5>Turno confirmado</h5>
                <hr>
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Paciente</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        
                            foreach( $resultado_nturno as $dato): 
                            
                        ?>

                            <tr>
                            <th scope="row"> <?php echo $dato['NUMERO']; ?> </th>
                            <td> <?php echo $dato['FECHA']; ?> </td>
                            <td> <?php echo $dato['HORARIO']; ?> </td> </td>
                            <td> <?php echo $dato['NOMBRE_PACIENTE']; ?> </td> </td>
                            </tr>
                            
                        <?php  
                        
                            /*
                                Cerramos el ciclo foreach
                            */
                            endforeach;

                        ?>
                        
                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

<?php
    /*
        Cerramos conexión de base de datos y sentencia
    */
    $pdo = null;
?>