<?php
    /*
        Iniciar una nueva sesión o reanudar la existente
    */
    session_start();

    //CONECTAR A LA BASE DE DATOS
    include_once 'conexion.php';

    $usuario_login = $_POST['nombre_usuario'];
    $contrasena_login = $_POST['contrasena'];

    //VERIFICAR SI USUARIO EXISTE EN LA BASE DE DATOS
    $sql = 'SELECT * FROM usuario WHERE nombre_usuario = ?';
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute(array($usuario_login));
    $resultado = $sentencia->fetch();

    if(!$resultado){
        echo 'No existe usuario';
        die();
    }

    //VERIFICAR CONTRASEÑA
    if(password_verify($contrasena_login, $resultado['CONTRASENA'])){
        //LAS CONTRASEÑAS SON IGUALES
        $_SESSION['usuario'] = $usuario_login;
        echo 'Sesión iniciada correctamente';
        header('Location:restringido.php');
    }
    else {
        echo 'No son iguales las contraseñas!';
        die();
    }

?>