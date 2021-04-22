function validar_alta_medico(){

    var dni_med_nuevo = document.getElementById('dni_med_nuevo').value.length;
    var nombre_med_nuevo = document.getElementById('nombre_med_nuevo').value.length;

    //IDENTIFICADOR DE PERMISO CORRESPONDIENTE A UN PACIENTE
    var permiso_med_nuevo = document.getElementById('permiso_med_nuevo').value;
    
    var direccion_med_nuevo = document.getElementById('direccion_med_nuevo').value.length;
    var localidad_med_nuevo = document.getElementById('localidad_med_nuevo').value.length;
    var celular_med_nuevo = document.getElementById('celular_med_nuevo').value.length;

    //NO ES OBLIGATORIO CARGAR UN NÚMERO DE TELÉFONO FIJO
    var tele_fijo_med_nuevo = document.getElementById('tele_fijo_med_nuevo').value.length;

    if(dni_med_nuevo == 8 && nombre_med_nuevo > 4 && permiso_med_nuevo == "MED" && direccion_med_nuevo > 4 && localidad_med_nuevo > 4 && celular_med_nuevo >= 8){
        document.getElementById('agregar_med_nuevo').disabled = false;
    }else{
        document.getElementById('agregar_med_nuevo').disabled = true;
    }
    
}

/* */

var dni_med_nuevo = document.getElementById('dni_med_nuevo');
var nombre_med_nuevo = document.getElementById('nombre_med_nuevo');
var direccion_med_nuevo = document.getElementById('direccion_med_nuevo');
var localidad_med_nuevo = document.getElementById('localidad_med_nuevo');
var celular_med_nuevo = document.getElementById('celular_med_nuevo');

dni_med_nuevo.onkeyup = validar_alta_medico;
nombre_med_nuevo.onkeyup = validar_alta_medico;
direccion_med_nuevo.onkeyup = validar_alta_medico;
localidad_med_nuevo.onkeyup = validar_alta_medico;
celular_med_nuevo.onkeyup = validar_alta_medico;