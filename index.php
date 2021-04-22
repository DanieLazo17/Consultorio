<?php
    date_default_timezone_set("America/Argentina/Buenos_Aires");

    include_once 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Primeros Pasos</title>

    <style>
        
        .menu a{
            color: white;
        }
        .menu a:link{
            color: white;
        }
        .menu a:hover{
            color: #81c784;
        }
        footer{
            text-align: center;
        }
        a:link, a:visited {
            color: #ffffff;
            text-decoration: none;
        }

        
    </style>
</head>
<body>

    <header class="p-3 mb bg-dark text-white">
        <div class="container">
            <div class="row">
                <!--
                <div class="col-xs-12 col-sm-1">
                    <a href="index.php">
                        <img src="logo.png" alt="" width="50" style="border-radius: 100px;">
                    </a>
                </div>
                -->
                <!--
                <div class="col-xs-12 col-sm-1">
                    <p style="font-size: 50px;">PP</p>
                </div>
                -->

                <div class="col-xs-12 col-sm-6">
                    <a href="index.php">
                        <h1>Primeros Pasos</h1>
                    </a>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <ul class="nav justify-content-end menu">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Planes de Salud</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="formulario.php" target="_blank" tabindex="-1" aria-disabled="true">Iniciar Sesión</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        
    </header>
    
    <div class="alert alert-info informacion mb-0" role="alert">
        <?php
            $informacion = "Coronavirus COVID-19 conocé información y recomendaciones del ";
            echo $informacion;
            echo '<a href="https://www.argentina.gob.ar/salud/coronavirus-COVID-19" target="_blank" class="alert-link">Ministerio de Salud</a>';
        ?>
    </div>

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="https://www.argentina.gob.ar/salud/coronavirus-COVID-19" target="_blank">
                    <img src="Coronavirus.png" class="d-block w-100" alt="...">
                </a>
                
            <div class="carousel-caption d-none d-md-block">
                <h5>Quedate en casa</h5>
                <p>Consulta información del COVID-19</p>
            </div>
            </div>
            <div class="carousel-item">
                <a href="formulario.php" target="_blank">
                    <img src="Turno.png" class="d-block w-100" alt="...">
                </a>
                
            <div class="carousel-caption d-none d-md-block">
                <h5>Consulta tus datos personales</h5>
                <p>También podes revisar tus próximos turnos</p>
            </div>
            </div>
            <div class="carousel-item">
                <a href="https://www.argentina.gob.ar/salud/prevencionycuidados" target="_blank">
                    <img src="Hijos.png" class="d-block w-100" alt="...">
                </a>
            <div class="carousel-caption d-none d-md-block">
                <h5>Cómo educar a nuestros hijos</h5>
                <p></p>
            </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <footer class="p-3 mb bg-dark text-white">
        <p>
            <?php
                echo autor();
                echo date('Y');
                
            ?>
        </p>

        <p>
            D & S
        </p>
    </footer>
    
    <?php
        function autor(){
            return 'Copyrigth &copy ';
        }
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php
    /*
        Cerramos conexión de base de datos y sentencia
    */
    $pdo = null;
?>