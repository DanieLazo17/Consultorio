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
    $telefono_celular = $_POST['telefono_celular'];
    
    include_once 'conexion.php';

    $sql_editar = 'UPDATE administracion SET telefono_celular=? WHERE dni=?';
    $sentencia_editar = $pdo->prepare($sql_editar);
    $sentencia_editar->execute(array($telefono_celular, $dni));

    /*
        Cerramos conexión de base de datos y sentencia
    */
    
    $pdo = null;
    $sentencia_editar = null;

    header('location:administracion.php');
    
?>