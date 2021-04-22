function valida_nombre_medico(){

    var nombre_medico = document.getElementById('nombre_medico').value.length;

    if(nombre_medico >= 4){
        document.getElementById('btn_nombre_medico').disabled = false;
    }else{
        document.getElementById('btn_nombre_medico').disabled = true;
    }

}

var nombre_medico = document.getElementById('nombre_medico');

nombre_medico.onkeyup = valida_nombre_medico;