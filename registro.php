<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Registro</title>
  </head>
  <body>
    <h1 class="text-center">Registración en el sistema</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="generar_usuario.php" method="POST" class="mb-4">
                    <label>DNI</label>
                    <input type="number" name="dni_usuario" id="dni_nuevo" class="form-control">
                    <label>Nombre de usuario</label>
                    <input type="text" name="nuevo_usuario" id="usuario_nuevo" class="form-control" maxlength="10">
                    <small class="text-muted">
                      Debe tener como máximo 10 caracteres.
                    </small>
                    <br>
                    <label>Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena_nueva" class="form-control" pattern="(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$">
                    <small class="text-muted">
                      Debe tener 1 letra mayúscula, 1 letra minúscula, 1 número y como mínimo 8 caracteres.
                    </small>
                    <br>
                    <label>Repetir contraseña</label>
                    <input type="password" name="contrasena2" id="contrasena_nueva2" class="form-control" pattern="(?=(.*[0-9]))((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.{8,}$">
                    
                    <!--<label>Consulta</label>
                    <textarea class="form-control" name="consulta" id="" cols="30" rows="10"></textarea>-->
                    <button type="submit" class="btn btn-primary mt-3" disabled="true" id="boton_subir">Subir</button>
                </form>
              
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="validaciones.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>