function valida_dni_paciente(){

    var dni_paciente = document.getElementById('dni_paciente').value.length;

    if(dni_paciente >= 7){
        document.getElementById('btn_dni_paciente').disabled = false;
    }else{
        document.getElementById('btn_dni_paciente').disabled = true;
    }

}

var dni_paciente = document.getElementById('dni_paciente');

dni_paciente.onkeyup = valida_dni_paciente;