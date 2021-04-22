function valida_nombre_paciente(){

    var nombre_paciente = document.getElementById('nombre_paciente').value.length;

    if(nombre_paciente >= 4){
        document.getElementById('btn_nombre_paciente').disabled = false;
    }else{
        document.getElementById('btn_nombre_paciente').disabled = true;
    }

}

var nombre_paciente = document.getElementById('nombre_paciente');

nombre_paciente.onkeyup = valida_nombre_paciente;