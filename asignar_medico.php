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


    //NO PERMITIR ACCESO AL ARCHIVO LOCAL ASIGNAR MÉDICO A TRAVÉS DE LA URL
    if( !isset($_POST['dni']) ){
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
                    //CAPTURAR DNI A TRAVÉS DEL MÉTODO POST
                    $dni = $_POST['dni'];

                    //BUSCAR DATOS DEL PACIENTE EN LA TABLA
                    $sql_paciente = 'SELECT DNI, NOMBRE, NOM_OBRA_SOCIAL FROM paciente WHERE dni=?';
                    $sentencia_paciente = $pdo->prepare($sql_paciente);
                    $sentencia_paciente->execute(array($dni));
                    $resultado_paciente = $sentencia_paciente->fetch();

                    /*
                        Cerramos conexión de base de datos y sentencia
                    */
                    $sentencia_paciente = null;

                    if(!$resultado_paciente){
                        echo 'Paciente no registrado en sistema';
                        echo '<br><a href="administracion.php?campo=asignar_medico">Volver</a>';
                        die();
                    }
                    
                    //echo 'Paciente registrado';

                    //VERIFICAR QUE EL PACIENTE NO TENGA ASIGNADO UN MÉDICO
                    $sql_busqueda = 'SELECT DNI_PAC FROM med_pac WHERE dni_pac=?';
                    $sentencia_busqueda = $pdo->prepare($sql_busqueda);
                    $sentencia_busqueda->execute(array($dni));
                    $resultado_busqueda = $sentencia_busqueda->fetch();

                    /*
                        Cerramos conexión de base de datos y sentencia
                    */
                    $sentencia_busqueda = null;
                    /*
                        
                    
                        IMPORTANTE
                        
                        
                    */
                    //MOSTRAR RESULTADO DEVUELTO POR EL MÉTODO FETCH

                    //var_dump($resultado_busqueda['DNI_PAC']);

                    if( isset($resultado_busqueda['DNI_PAC']) ){
                        echo 'Paciente ya tiene un médico asignado';
                        echo '<br><a href="administracion.php?campo=asignar_medico">Volver</a>';
                        die();
                    }


                    //BUSCAR MÉDICOS EN LA TABLA
                    $sql_medico = 'SELECT * FROM medico';
                    $sentencia_medico = $pdo->prepare($sql_medico);
                    $sentencia_medico->execute();
                    $resultado_medico = $sentencia_medico->fetchAll();


                    //var_dump($resultado_permiso['DNI']);

                    /*
                        Cerramos conexión de base de datos y sentencia
                    */
                    $sentencia_medico = null;
                    $pdo = null;
                ?>

                <h1>Datos protegidos</h1>
            
            </div>

            <div class="col-md-2">

                <?php
                    if( isset($_SESSION['usuario'])){
                        echo 'Bienvenida '. $_SESSION['usuario'];
                        echo '<br><a href="cerrar.php">Cerrar Sesión</a>';
                    }
                ?>
            
            </div>

        </div>
    
    </div>

    <div class="container mt-4 mb-4">

        <div class="row">

            <div class="col-md-12">
                <h2>VERIFICAR DATOS DE PACIENTE Y ASIGNAR MÉDICO</h2>
            </div>

            <div class="col-md-6">
                        
                <form method="POST" action="asignacion.php">
                    <input type="text" class="form-control mt-3" value="<?php echo $resultado_paciente['DNI']; ?>" disabled>
                    <input type="hidden" name="dni_pac" value="<?php echo $resultado_paciente['DNI']; ?>" id="dni_pac">

                    <input type="text" class="form-control mt-3" value="<?php echo $resultado_paciente['NOMBRE']; ?>" disabled>
                    <input type="hidden" name="nombre_pac" value="<?php echo $resultado_paciente['NOMBRE']; ?>" id="nombre_pac">
                        
                    <input type="text" class="form-control mt-3" value="<?php echo $resultado_paciente['NOM_OBRA_SOCIAL']; ?>" disabled>
                    <input type="hidden" name="obra_social_pac" value="<?php echo $resultado_paciente['NOM_OBRA_SOCIAL']; ?>" id="obra_social_pac">
                            

                    <select class="form-control mt-3" name="nombre_med" id="obra_social_pac_nuevo" required>
                        <option value="">Médico</option>
                        <?php
                            /*
                                Sentencia para recorrer el arreglo $resultado_medico
                            */
                            foreach($resultado_medico as $dato):
                        ?>
                                    
                            <option value="<?php echo $dato['NOMBRE']; ?>"> <?php echo $dato['NOMBRE']; ?> </option>

                        <?php
                            /*
                                Cerramos el ciclo foreach
                            */
                            endforeach;
                        ?>
                    </select>
 
                    <button id="asignar_med_pac" class="btn btn-primary mt-3">Asignar</button>
                </form>

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