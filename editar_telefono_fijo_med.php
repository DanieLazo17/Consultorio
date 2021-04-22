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

    $sql_editar = 'UPDATE medico SET telefono_fijo=? WHERE dni=?';
    $sentencia_editar = $pdo->prepare($sql_editar);
    $sentencia_editar->execute(array($telefono_fijo, $dni));

    /*
        Cerramos conexión de base de datos y sentencia
    */
    
    $pdo = null;
    $sentencia_editar = null;

    header('location:medico.php');
    
?>