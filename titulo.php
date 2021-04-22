<header class="p-3 mb bg-dark text-white">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-6">
                <a href="index.php" style="color: #ffffff; text-decoration: none;">
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