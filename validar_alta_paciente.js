function validar_alta_paciente(){

    var dni_pac_nuevo = document.getElementById('dni_pac_nuevo').value.length;
    var nombre_pac_nuevo = document.getElementById('nombre_pac_nuevo').value.length;

    //IDENTIFICADOR DE PERMISO CORRESPONDIENTE A UN PACIENTE
    var permiso_pac_nuevo = document.getElementById('permiso_pac_nuevo').value;
    
    var direccion_pac_nuevo = document.getElementById('direccion_pac_nuevo').value.length;
    var localidad_pac_nuevo = document.getElementById('localidad_pac_nuevo').value.length;
    var celular_pac_nuevo = document.getElementById('celular_pac_nuevo').value.length;

    //NO ES OBLIGATORIO CARGAR UN NÚMERO DE TELÉFONO FIJO
    var tele_fijo_pac_nuevo = document.getElementById('tele_fijo_pac_nuevo').value.length;

    if(dni_pac_nuevo == 8 && nombre_pac_nuevo > 4 && permiso_pac_nuevo == "PAC" && direccion_pac_nuevo > 4 && localidad_pac_nuevo > 4 && celular_pac_nuevo >= 8){
        document.getElementById('agregar_pac_nuevo').disabled = false;
    }else{
        document.getElementById('agregar_pac_nuevo').disabled = true;
    }
    
}

/* */

var dni_pac_nuevo = document.getElementById('dni_pac_nuevo');
var nombre_pac_nuevo = document.getElementById('nombre_pac_nuevo');
var direccion_pac_nuevo = document.getElementById('direccion_pac_nuevo');
var localidad_pac_nuevo = document.getElementById('localidad_pac_nuevo');
var celular_pac_nuevo = document.getElementById('celular_pac_nuevo');

dni_pac_nuevo.onkeyup = validar_alta_paciente;
nombre_pac_nuevo.onkeyup = validar_alta_paciente;
direccion_pac_nuevo.onkeyup = validar_alta_paciente;
localidad_pac_nuevo.onkeyup = validar_alta_paciente;
celular_pac_nuevo.onkeyup = validar_alta_paciente;