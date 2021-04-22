function valida_fecha(){

    var fecha_inicial = document.getElementById('fecha_inicial').value;
    var fecha_final = document.getElementById('fecha_final').value;

     /* SEPARAR AÑO, MES Y DÍA DE LA FECHA INGRESADA EN EL FORMULARIO */

     var i;
     var anioi = 0;
     var aniof = 0;
     for(i=0; i < 4; i++){
         anioi = anioi + fecha_inicial[i];
         aniof = aniof + fecha_final[i];
     }
 
     var j;
     var mesi = 0;
     var mesf = 0;
     for(j=5; j < 7; j++){
         mesi = mesi + fecha_inicial[j];
         mesf = mesf + fecha_final[j];
     }
 
     var z;
     var diai = 0;
     var diaf = 0;
     for(z=8; z < 10; z++){
         diai = diai + fecha_inicial[z];
         diaf = diaf + fecha_final[z];
     }

    //document.getElementById('btn_fecha').disabled = false;
    
    if(aniof > anioi){

        document.getElementById('btn_fecha').disabled = false;

    }else if(aniof == anioi){

        if(mesf > mesi){

            document.getElementById('btn_fecha').disabled = false;

        }else if(mesf == mesi){

            if(diaf > diai){

                document.getElementById('btn_fecha').disabled = false;

            }else if(diaf == diai){
          
                document.getElementById('btn_fecha').disabled = false;           

            }else{

                document.getElementById('btn_fecha').disabled = true;

            }

        }else{

            document.getElementById('btn_fecha').disabled = true;

        }

    }else{

        document.getElementById('btn_fecha').disabled = true;

    }
}

var fecha_inicial = document.getElementById('fecha_inicial');
var fecha_final = document.getElementById('fecha_final');

/* An HTML element has been changed */

fecha_inicial.onchange = valida_fecha;
fecha_final.onchange = valida_fecha;