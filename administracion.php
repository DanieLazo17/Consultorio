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

    //var_dump($resultado_unico);
    if($resultado_unico){
        //var_dump($resultado_unico);
    }
    $dni = $resultado_unico['DNI'];

    //VERIFICAR SI ALGÚN USUARIO SIN PERMISO DESEA ACCEDER
    if( !($resultado_unico['ID_PERMISO'] == "ADMIN")){
        header('Location:formulario.php');
    }

    //var_dump($resultado_permiso['DNI']);

    //BUSCAR EL DNI DEL USUARIO ACTUAL EN LA TABLA ADMINISTRACIÓN PARA OBTENER SUS DATOS PERSONALES Y PERMISOS
    $sql_dni = 'SELECT * FROM administracion WHERE dni=?';
    $sentencia_dni = $pdo->prepare($sql_dni);
    $sentencia_dni->execute(array($dni));
    $resultado_dni = $sentencia_dni->fetch();

    //var_dump($resultado_dni);

    $sentencia_unica = null;
    $sentencia_dni = null;





    if($_GET){
        
        if($_GET['campo'] == "alta_paciente"){
            
            //LEER DE LA TABLA OBRA_SOCIAL TODAS LAS OBRAS SOCIALES ADMITIDAS EN EL CONSULTORIO
            $sql_os = 'SELECT * FROM obra_social ORDER BY NOMBRE_OBRA_SOCIAL ASC';
            $sentencia_os = $pdo->prepare($sql_os);
            $sentencia_os->execute();
            $resultado_os = $sentencia_os->fetchAll();

            $sentencia_os = null;

        }
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
    <link rel="stylesheet" href="estilo_titulo.css">

    <title>Datos protegidos</title>
  </head>
  <body>

    <?php /* include 'titulo.php'; */ ?>

    <!-- Titulo -->
    <div class="container mt-4">

        <div class="row">

            <div class="col-md-10">

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

            <div class="col-md-6">

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="administracion.php?campo=agregar_turno">Agregar turno</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="administracion.php?campo=asignar_medico">Asignar médico</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="administracion.php?campo=ver_turnos">Ver turnos</a>
                    </li>
                </ul>

                <!--  -->
                <?php if($_GET): ?>

                    <!-- Enviamos datos a través de la URL usando el método GET -->
                    <?php if($_GET['campo'] == "agregar_turno"): ?>

                        <h2>AGREGAR TURNO</h2>

                        <form method="POST" action="turno.php">
                            <input type="text" class="form-control" name="dni_paciente" placeholder="Número de documento del paciente">
                            
                            <button class="btn btn-primary mt-3">Buscar</button>
                        </form>

                    <?php endif ?>

                    <!-- Enviamos datos a través de la URL usando el método GET -->
                    <?php if($_GET['campo'] == "asignar_medico"): ?>

                        <h2>ASIGNAR MÉDICO</h2>

                        <form method="POST" action="asignar_medico.php">
                            <input type="text" class="form-control" name="dni" placeholder="Número de documento del paciente">
                        
                            <button class="btn btn-primary mt-3">Buscar</button>

                        </form>

                    <?php endif ?>

                    <!-- Enviamos datos a través de la URL usando el método GET -->
                    <?php if($_GET['campo'] == "ver_turnos"): ?>

                        <h2>VER TURNOS</h2>

                        <form method="POST" action="ver_turnos.php">

                            <button class="btn btn-primary mt-3">Buscar</button>

                        </form>

                    <?php endif ?>

                <?php endif ?>

            </div>

            <div class="col-md-6">
                    
                <ul class="nav nav-tabs">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="administracion.php?campo=alta_medico">Alta médico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="administracion.php?campo=alta_paciente">Alta paciente</a>
                    </li>
                    

                </ul>

                <!--  -->
                <?php if($_GET): ?>

                    <!-- Enviamos datos a través de la URL usando el método GET -->
                    <?php if($_GET['campo'] == "alta_paciente"): ?>

                        <h2>ALTA PACIENTE</h2>
                        
                        <form method="POST" action="alta_paciente.php">
                            <input type="text" class="form-control" name="dni" id="dni_pac_nuevo" placeholder="DNI">
                            <input type="text" class="form-control mt-3" name="nombre" id="nombre_pac_nuevo" placeholder="Nombre y apellido">
                            <input type="text" class="form-control mt-3" value="PAC" disabled>
                            <input type="hidden" name="permiso" value="PAC" id="permiso_pac_nuevo">
                            

                            <select class="form-control mt-3" name="obra_social" id="obra_social_pac_nuevo" required>
                                <option value="">Obra Social</option>
                                <?php
                                    /*
                                        Sentencia para recorrer el arreglo $resultado_os
                                    */
                                    foreach($resultado_os as $dato):
                                ?>
                                    
                                    <option value="<?php echo $dato['NOMBRE_OBRA_SOCIAL']; ?>"> <?php echo $dato['NOMBRE_OBRA_SOCIAL']; ?> </option>

                                <?php
                                    /*
                                        Cerramos el ciclo foreach
                                    */
                                    endforeach;
                                ?>
                            </select>

                            

                            <!--<input type="text" class="form-control mt-3" name="obra_social" id="obra_social_pac_nuevo" placeholder="Obra Social">-->
                            <input type="text" class="form-control mt-3" name="direccion" id="direccion_pac_nuevo" placeholder="Dirección">
                            <input type="text" class="form-control mt-3" name="localidad" id="localidad_pac_nuevo" placeholder="Localidad">
                            <input type="text" class="form-control mt-3" name="telefono_celular" id="celular_pac_nuevo" placeholder="Teléfono celular">
                            <input type="text" class="form-control mt-3" name="telefono_fijo" id="tele_fijo_pac_nuevo" placeholder="Teléfono fijo">
                            <button id="agregar_pac_nuevo" class="btn btn-primary mt-3" disabled="true">Agregar</button>
                        </form>

                    <?php endif ?>

                    <!-- Enviamos datos a través de la URL usando el método GET -->
                    <?php if($_GET['campo'] == "alta_medico"): ?>

                        <h2>ALTA MÉDICO</h2>

                        <form method="POST" action="alta_medico.php">
                            <input type="text" class="form-control" name="dni" id="dni_med_nuevo" placeholder="DNI">
                            <input type="text" class="form-control mt-3" name="nombre" id="nombre_med_nuevo" placeholder="Nombre y apellido">
                            <input type="text" class="form-control mt-3" value="MED" disabled>
                            <input type="hidden" name="permiso" value="MED" id="permiso_med_nuevo">
                            <input type="text" class="form-control mt-3" name="direccion" id="direccion_med_nuevo" placeholder="Dirección">
                            <input type="text" class="form-control mt-3" name="localidad" id="localidad_med_nuevo" placeholder="Localidad">
                            <input type="text" class="form-control mt-3" name="telefono_celular" id="celular_med_nuevo" placeholder="Teléfono celular">
                            <input type="text" class="form-control mt-3" name="telefono_fijo" id="tele_fijo_med_nuevo" placeholder="Teléfono fijo">
                            <button id="agregar_med_nuevo" class="btn btn-primary mt-3" disabled="true">Agregar</button>
                        </form>

                    <?php endif ?>

                <?php endif ?>

            </div>
            
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="validar_alta_paciente.js"></script>
    <script type="text/javascript" src="validar_alta_medico.js"></script>
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