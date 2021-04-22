function validar(){

    var fecha_turno = document.getElementById('fecha_turno').value;
    var horario_turno = document.getElementById('horario_turno').value;

    console.log(fecha_turno);

    /* OBTENER FECHA ACTUAL  */
    var d = new Date();

    var anio = d.getFullYear();
    var mes = d.getMonth();
    mes = mes + 1;
    var dia = d.getDate();

    var hora = d.getHours();
    var minuto = d.getMinutes();

    console.log(typeof(d));
    console.log(hora);
    console.log(anio);
    console.log(mes);
    console.log(typeof(mes));
    console.log(typeof(mes));
    console.log(dia);


    var h;
    var horax = 0;
    for(h=0; h < 2; h++){
        horax = horax + horario_turno[h];
    }

    console.log(horax);
    console.log(typeof(horax));

    var m;
    var minutox = 0;
    for(m=3; m < 5; m++){
        minutox = minutox + horario_turno[h];
    }

    /* SEPARAR AÑO, MES Y DÍA DE LA FECHA INGRESADA EN EL FORMULARIO */

    var i;
    var aniox = 0;
    for(i=0; i < 4; i++){
        aniox = aniox + fecha_turno[i];
    }

    console.log(aniox);
    console.log(typeof(aniox));

    var j;
    var mesx = 0;
    for(j=5; j < 7; j++){
        mesx = mesx + fecha_turno[j];
    }

    console.log(mesx);
    console.log(typeof(mesx));

    var z;
    var diax = 0;
    for(z=8; z < 10; z++){
        diax = diax + fecha_turno[z];
    }

    console.log(diax);
    console.log(typeof(diax));

    console.log(mesx > mes);

    if(aniox > anio){

        document.getElementById('boton_agregar').disabled = false;

    }else if(aniox == anio){

        if(mesx > mes){

            document.getElementById('boton_agregar').disabled = false;

        }else if(mesx == mes){

            if(diax > dia){

                document.getElementById('boton_agregar').disabled = false;

            }else if(diax == dia){

                if(horax > hora){
                    
                    document.getElementById('boton_agregar').disabled = false;

                }else{

                    document.getElementById('boton_agregar').disabled = true;

                }

            }else{

                document.getElementById('boton_agregar').disabled = true;

            }

        }else{

            document.getElementById('boton_agregar').disabled = true;

        }

    }else{

        document.getElementById('boton_agregar').disabled = true;

    }

}

var fecha_turno = document.getElementById('fecha_turno');
var horario_turno = document.getElementById('horario_turno');

/* An HTML element has been changed */

fecha_turno.onchange = validar;
horario_turno.onchange = validar;