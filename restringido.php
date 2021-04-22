<?php
    //CONECTAR A LA BASE DE DATOS
    include_once 'conexion.php';

    /*
        Iniciar una nueva sesión o reanudar la existente
    */
    session_start();

    if( isset($_SESSION['usuario'])){
        echo 'Bienvenido '. $_SESSION['usuario'];
        echo '<br><a href="cerrar.php">Cerrar Sesión</a>';
    }
    else{
        header('Location:formulario.php');
    }

    //LEER DE LA TABLA USUARIO SOLO EL REGISTRO DEL USUARIO ACTUAL PARA OBTENER SU IDENTIFICADOR DE PERMISO
    $usuario_actual = $_SESSION['usuario'];

    $sql_permiso = 'SELECT * FROM usuario WHERE nombre_usuario=?';
    $sentencia_permiso = $pdo->prepare($sql_permiso);
    $sentencia_permiso->execute(array($usuario_actual));
    $resultado_permiso = $sentencia_permiso->fetch();

    if($resultado_permiso['ID_PERMISO'] == "PAC"){

      header('Location:paciente.php');
    }

    if($resultado_permiso['ID_PERMISO'] == "MED"){

      header('Location:medico.php');

      //var_dump($resultado_permiso['DNI']);

      //BUSCAR EL DNI DEL MEDICO ACTUAL EN LA TABLA MEDICO PARA OBTENER SUS DATOS PERSONALES Y PERMISOS
      
    }

    if($resultado_permiso['ID_PERMISO'] == "ADMIN"){

      header('Location:administracion.php');

      //var_dump($resultado_permiso['DNI']);

      //BUSCAR EL DNI DEL ADMINISTRADOR ACTUAL EN LA TABLA ADMINISTRACION PARA OBTENER SUS DATOS PERSONALES Y PERMISOS
      
    }
    
    
?>