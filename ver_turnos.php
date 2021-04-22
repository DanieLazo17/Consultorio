<?php
    date_default_timezone_set("America/Argentina/Buenos_Aires");

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

    //BUSCAR PRÓXIMOS TURNOS EN LA VISTA VW TURNO
    /*

      BUSCAR PRÓXIMOS TURNOS

    */
    $anio = date("Y");
    $mes = date("m");
    $dia = date("d");

    $hora = date("H:i:s");

    $fecha = date("Y-m-d");
    $estado_turno = NULL;

    //BUSCAR TURNOS DE LA FECHA ACTUAL EN LA VISTA VW TURNO
    $sql_vista = 'SELECT * FROM vw_turno WHERE FECHA = ? AND ESTADO = ? ORDER BY HORARIO';
    $sentencia_vista = $pdo->prepare($sql_vista);
    $sentencia_vista->execute(array($fecha, $estado_turno));
    $resultado_vista = $sentencia_vista->fetchAll();

    /*
        Cerramos conexión de base de datos y sentencia
    */
    $sentencia_vista = null;

    //BUSCAR EN LA VISTA VW TURNO CUANDO SE ENVIAN DATOS A TRAVÉS DEL MÉTODO POST
    if($_GET){

        if($_GET['campo'] == "fecha"){

            if($_POST){
                $fecha_incial = $_POST['fecha_inicial'];
                $fecha_final = $_POST['fecha_final'];

                //echo $fecha_final;

                //BORRAR DATOS DEL ARREGLO
                $resultado_vista = null;

                //BUSCAR LISTA DE TURNOS EN LA VISTA VW TURNO
                $sql_vista = 'SELECT * FROM vw_turno WHERE FECHA >= ? AND FECHA <= ? ORDER BY FECHA, HORARIO';
                $sentencia_vista = $pdo->prepare($sql_vista);
                $sentencia_vista->execute(array($fecha_incial, $fecha_final));
                $resultado_vista = $sentencia_vista->fetchAll();
                
            }
        }

        if($_GET['campo'] == "turno"){

            if($_POST){
                $numero_turno = $_POST['numero_turno'];

                //BORRAR DATOS DEL ARREGLO
                $resultado_vista = null;

                $sql_vista = 'SELECT * FROM vw_turno WHERE NUMERO = ?';
                $sentencia_vista = $pdo->prepare($sql_vista);
                $sentencia_vista->execute(array($numero_turno));
                $resultado_vista = $sentencia_vista->fetchAll();

                //var_dump($sentencia_vista->execute(array($numero_turno)));
                //var_dump($sentencia_vista->fetchAll());

                //SI LA CONSULTA NO ENCUENTRA NINGÚN NÚMERO DE TURNO EL ARREGLO NO TENDRA NINGUN VALOR
                //var_dump($resultado_vista);
                
            }
        }

        if($_GET['campo'] == "dni_paciente"){

            if($_POST){
                $dni_paciente = $_POST['dni_paciente'];

                //BORRAR DATOS DEL ARREGLO
                $resultado_vista = null;

                $sql_vista = 'SELECT * FROM vw_turno WHERE DNI_PACIENTE = ?';
                $sentencia_vista = $pdo->prepare($sql_vista);
                $sentencia_vista->execute(array($dni_paciente));
                $resultado_vista = $sentencia_vista->fetchAll();
            }
        }

        if($_GET['campo'] == "nombre_paciente"){

            if($_POST){
                $nombre_paciente = $_POST['nombre_paciente'];

                //BORRAR DATOS DEL ARREGLO
                $resultado_vista = null;

                //Ejecutar una sentencia preparada con una variable y valor vinculados
                $sql_vista = 'SELECT * FROM vw_turno WHERE NOMBRE_PACIENTE LIKE :nombre_paciente';
                $sentencia_vista = $pdo->prepare($sql_vista);
                $sentencia_vista->bindValue(':nombre_paciente', "%{$nombre_paciente}%");
                $sentencia_vista->execute();
                $resultado_vista = $sentencia_vista->fetchAll();
            }
        }

        if($_GET['campo'] == "dni_medico"){

            if($_POST){
                $dni_medico = $_POST['dni_medico'];

                //BORRAR DATOS DEL ARREGLO
                $resultado_vista = null;

                $sql_vista = 'SELECT * FROM vw_turno WHERE DNI_MEDICO = ?';
                $sentencia_vista = $pdo->prepare($sql_vista);
                $sentencia_vista->execute(array($dni_medico));
                $resultado_vista = $sentencia_vista->fetchAll();
            }
        }

        if($_GET['campo'] == "nombre_medico"){

            if($_POST){
                $nombre_medico = $_POST['nombre_medico'];

                //BORRAR DATOS DEL ARREGLO
                $resultado_vista = null;

                //Ejecutar una sentencia preparada con una variable y valor vinculados
                $sql_vista = 'SELECT * FROM vw_turno WHERE NOMBRE_MEDICO LIKE :nombre_medico';
                $sentencia_vista = $pdo->prepare($sql_vista);
                $sentencia_vista->bindValue(':nombre_medico', "%{$nombre_medico}%");
                $sentencia_vista->execute();
                $resultado_vista = $sentencia_vista->fetchAll();
            }
        }

        if($_GET['campo'] == "os"){

            if($_POST){
                $obra_social = $_POST['obra_social'];

                //BORRAR DATOS DEL ARREGLO
                $resultado_vista = null;

                $sql_vista = 'SELECT * FROM vw_turno WHERE NOM_OBRA_SOCIAL = ?';
                $sentencia_vista = $pdo->prepare($sql_vista);
                $sentencia_vista->execute(array($obra_social));
                $resultado_vista = $sentencia_vista->fetchAll();
            }
        }

        //BUSCAR POR NOMBRE DE PACIENTE

        //BUSCAR POR NOMBRE DE MÉDICO
    }

    /*
        Cerramos conexión de base de datos y sentencia
    */
    $pdo = null;
    $sentencia_vista = null;
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
                <h4>Buscar turnos por</h4>
            </div>

            <div class="col-md-12">

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="ver_turnos.php?campo=fecha">Fecha</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="ver_turnos.php?campo=turno">Número</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="ver_turnos.php?campo=dni_paciente">DNI de paciente</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="ver_turnos.php?campo=nombre_paciente">Nombre de paciente</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="ver_turnos.php?campo=dni_medico">DNI de médico</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="ver_turnos.php?campo=nombre_medico">Nombre de médico</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="ver_turnos.php?campo=os">Obra Social</a>
                    </li>
                </ul>
                
            </div>

            <div class="col-md-6 mt-2">
                <?php if($_GET): ?>

                    <!-- Enviamos datos a través de la URL usando el método GET -->
                    <?php if($_GET['campo'] == "fecha"): ?>

                        <form method="POST">
                            <label for="">Desde</label>
                            <input type="date" class="form-control mb-2" name="fecha_inicial" id="fecha_inicial">
                            <label for="">Hasta</label>
                            <input type="date" class="form-control" name="fecha_final" id="fecha_final">
                            
                            <button class="btn btn-primary mt-3" id="btn_fecha" disabled>Buscar</button>
                        </form>

                    <?php endif ?>

                    <?php if($_GET['campo'] == "turno"): ?>

                        <form method="POST">
                            <input type="number" class="form-control" name="numero_turno" id="numero_turno" placeholder="Número de turno">

                            <button class="btn btn-primary mt-3" id="btn_turno" disabled>Buscar</button>

                        </form>

                    <?php endif ?>

                    <?php if($_GET['campo'] == "dni_paciente"): ?>

                        <form method="POST">
                            <input type="text" class="form-control" name="dni_paciente" id="dni_paciente" placeholder="Número de documento del paciente">
                        
                            <button class="btn btn-primary mt-3" id="btn_dni_paciente" disabled>Buscar</button>

                        </form>

                    <?php endif ?>

                    <?php if($_GET['campo'] == "nombre_paciente"): ?>

                        <form method="POST">
                            <input type="text" class="form-control" name="nombre_paciente" id="nombre_paciente" placeholder="Nombre del paciente">

                            <button class="btn btn-primary mt-3" id="btn_nombre_paciente" disabled>Buscar</button>

                        </form>

                    <?php endif ?>

                    <?php if($_GET['campo'] == "dni_medico"): ?>

                        <form method="POST">
                            <input type="text" class="form-control" name="dni_medico" id="dni_medico" placeholder="Número de documento del médico">

                            <button class="btn btn-primary mt-3" id="btn_dni_medico" disabled>Buscar</button>

                        </form>

                    <?php endif ?>

                    <?php if($_GET['campo'] == "nombre_medico"): ?>

                        <form method="POST">
                            <input type="text" class="form-control" name="nombre_medico" id="nombre_medico" placeholder="Nombre del médico">

                            <button class="btn btn-primary mt-3" id="btn_nombre_medico" disabled>Buscar</button>

                        </form>

                    <?php endif ?>

                    <?php if($_GET['campo'] == "os"): ?>

                        <form method="POST">
                            <input type="text" class="form-control" name="obra_social" id="obra_social" placeholder="Nombre de Obra Social">

                            <button class="btn btn-primary mt-3" id="btn_obra_social" disabled>Buscar</button>

                        </form>

                    <?php endif ?>

                <?php endif ?>
                
            </div>
            
            <div class="col-md-12 mt-4">

                <?php
                    if($_GET){
                        echo '<h4>Lista de turnos</h4>';
                    }

                    if(!$_GET){
                        echo '<h4>Próximos turnos</h4>';
                    }
                ?>
                
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">DNI de Paciente</th>
                        <th scope="col">Obra Social</th>
                        <th scope="col">Médico</th>
                        <th scope="col">DNI de Médico</th>
                        <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                        
                            foreach( $resultado_vista as $dato): 
                            
                        ?>

                            <tr>
                                <th scope="row"> <?php echo $dato['NUMERO']; ?> </th>
                                <td> <?php echo $dato['FECHA']; ?> </td>
                                <td> <?php echo $dato['HORARIO']; ?> </td>
                                <td> <?php echo $dato['NOMBRE_PACIENTE']; ?> </td>
                                <td> <?php echo $dato['DNI_PACIENTE']; ?> </td>
                                <td> <?php echo $dato['NOM_OBRA_SOCIAL']; ?> </td>
                                <td> <?php echo $dato['NOMBRE_MEDICO']; ?> </td>
                                <td> <?php echo $dato['DNI_MEDICO']; ?> </td>
                                <td>

                                    <?php if( $dato['ESTADO'] == NULL ): ?>


                                        <a href="cancelar_turno.php?id=<?php echo $dato['NUMERO']; ?>" class="float-right mr-1">
                                            <i class="fas fa-window-close"></i>
                                        </a>
                                        
                                        <a href="confirmar_turno.php?id=<?php echo $dato['NUMERO']; ?>">
                                            <i class="fas fa-check-square"></i>
                                        </a>

                                    <?php endif ?>

                                    <?php if( $dato['ESTADO'] != NULL ): ?>

                                        <?php echo $dato['ESTADO']; ?>

                                    <?php endif ?>

                                </td>
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
    <script type="text/javascript" src="validar_busqueda_fecha.js"></script>
    <script type="text/javascript" src="validar_busqueda_numero.js"></script>
    <script type="text/javascript" src="validar_busqueda_dni_pac.js"></script>
    <script type="text/javascript" src="validar_busqueda_nom_pac.js"></script>
    <script type="text/javascript" src="validar_busqueda_dni_med.js"></script>
    <script type="text/javascript" src="validar_busqueda_nom_med.js"></script>
    <script type="text/javascript" src="validar_busqueda_os.js"></script>
    <script type="text/javascript" src=""></script>
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