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
    

    <div class="container mt-4">

        <div class="row">

            <div class="col-md-6">
                
                    <!--
                        ¿Cómo podemos imprimir nuestro arreglo $resultado_dni dentro del alerta en nuestro código HTML?

                        Podemos incluir PHP dentro de HTML
                    -->
                
                    <div class="alert alert-danger" role="alert">
                    <label>DNI: </label>
                    <?php echo $resultado_dni['DNI']; ?>
                    </div>

                    <div class="alert alert-danger" role="alert">
                    <label>Nombre: </label>
                    <?php echo $resultado_dni['NOMBRE']; ?>
                    </div>

                    <div class="alert alert-danger" role="alert">
                    <label>Dirección: </label>
                    <?php echo $resultado_dni['DIRECCION']; ?>
                    </div>

                    <div class="alert alert-danger" role="alert">
                    <label>Localidad: </label>
                    <?php echo $resultado_dni['LOCALIDAD']; ?>
                    </div>

                    <div class="alert alert-danger" role="alert">
                    <label>Teléfono de trabajo: </label>
                    <?php echo $resultado_dni['TELEFONO_TRABAJO']; ?>
                    </div>

                    <div class="alert alert-danger" role="alert">
                    <label>Teléfono celular: </label>
                    <?php echo $resultado_dni['TELEFONO_CELULAR']; ?>

                    <a href="cuenta_admin.php?campo=telefono_celular" class="float-right">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    </div>

            </div>

            <div class="col-md-6">

                <!-- EDITAR NÚMERO DE TELÉFONO MÓVIL -->
                    <?php if($_GET): ?>

                        <!-- Enviamos datos a través de la URL usando el método GET -->
                        <?php if($_GET['campo'] == "telefono_celular"): ?>

                            <h2>EDITAR TELÉFONO CELULAR</h2>
                            
                            <form method="POST" action="editar_celular_admin.php">
                                <input type="text" class="form-control" name="telefono_celular" value="<?php echo $resultado_dni['TELEFONO_CELULAR']; ?>">
                                <input type="hidden" name="dni" value="<?php echo $resultado_dni['DNI']; ?>">
                                <button class="btn btn-primary mt-3">Agregar</button>
                            </form>

                        <?php endif ?>
                        
                    <?php endif ?>
            </div>
            
        </div>

    </div>

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