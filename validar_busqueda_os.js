function valida_os(){

    var obra_social = document.getElementById('obra_social').value;

    if(obra_social == "Galeno" || obra_social == "IOMA" || obra_social == "OMINT"){
        document.getElementById('btn_obra_social').disabled = false;
    }else{
        document.getElementById('btn_obra_social').disabled = true;
    }

}

var obra_social = document.getElementById('obra_social');

obra_social.onkeyup = valida_os;