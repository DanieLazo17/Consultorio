function valida_nturno(){

    var numero_turno = document.getElementById('numero_turno').value;

    if(numero_turno >= 1){
        document.getElementById('btn_turno').disabled = false;
    }else{
        document.getElementById('btn_turno').disabled = true;
    }

}

var numero_turno = document.getElementById('numero_turno');

numero_turno.onkeyup = valida_nturno;