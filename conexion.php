<?php
    $link = 'mysql:host=localhost;dbname=consultorio';
    $usuario = 'root';
    $contraseña = '';

    try{
        /*
            La variable $pdo es un dato de tipo objeto de la clase PDO. Si la conexión a la base de datos funciona, 
            podremos llamar a sentencias como de lectura, escritura, para eliminar, editar, etc. en nuestra base de datos.
        */
        $pdo = new PDO($link, $usuario, $contraseña);

        //echo 'Conectado a Consultorio <br>';

        //echo'<br>';

        /*
            Para realizar una consulta de lectura a nuestra base de datos utilizamos la variable $pdo,
            $pdo->query('SELECT * FROM colores')
        */
        /*
        foreach($pdo->query('SELECT * FROM colores') as $fila){
            print_r($fila);
        }
        */
    }
    catch(PDOException $e){
        print "¡Error!: " . $e->getMessage() . "<br>";
        die();
    }

?>