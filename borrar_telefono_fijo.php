<?php
    //OPERACIÓN EDITAR
    /*
        Recibir en este archivo datos a través del método GET.

        Con el método GET enviamos datos a través de la URL
    */
    /*
        Demostramos cómo se trabaja con el método GET a través de la URL
    */
    /*
    echo 'editar.php?id=1&color=success&descripcion=este es un color verde';
    echo '<br>';
    */
    $dni = $_POST['dni'];
    $telefono_fijo = $_POST['telefono_fijo'];
    
    include_once 'conexion.php';

    $sql_borrar = 'UPDATE paciente SET TELEFONO_FIJO = ? WHERE DNI=?';
    $sentencia_borrar = $pdo->prepare($sql_borrar);
    $sentencia_borrar->execute(array($telefono_fijo , $dni));

    /*
        Cerramos conexión de base de datos y sentencia
    */
    
    $pdo = null;
    $sentencia_borrar = null;

    header('location:paciente.php');
    
?>