function validar(){

    var usuario_nuevo = document.getElementById('usuario_nuevo').value.length;
    var contrasena_nuevo = document.getElementById('contrasena_nueva').value.length;
    var contrasena_nuevo2 = document.getElementById('contrasena_nueva2').value.length;

    if(usuario_nuevo <=10 && contrasena_nuevo >=8 && contrasena_nuevo2 >=8){
        document.getElementById('boton_subir').disabled = false;
    }else{
        document.getElementById('boton_subir').disabled = true;
    }
}

var usuario_nuevo = document.getElementById('usuario_nuevo');
var contrasena_nuevo = document.getElementById('contrasena_nueva');
var contrasena_nuevo2 = document.getElementById('contrasena_nueva2');

usuario_nuevo.onkeyup = validar;
contrasena_nuevo.onkeyup = validar;
contrasena_nuevo2.onkeyup = validar;