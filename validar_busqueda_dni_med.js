function valida_dni_medico(){

    var dni_medico = document.getElementById('dni_medico').value.length;

    if(dni_medico >= 7){
        document.getElementById('btn_dni_medico').disabled = false;
    }else{
        document.getElementById('btn_dni_medico').disabled = true;
    }

}

var dni_medico = document.getElementById('dni_medico');

dni_medico.onkeyup = valida_dni_medico;