function sololetras(e){
    key=e.KeyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();

    letras = "abcdefghijklmñnopqrstuvwxyz";
    especiales = "8-37-38-46-164"
    teclado_especial=false;
    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial=true;break;
        }
    }
    if(letras.indexOf(teclado)==-1 && !teclado_especial){
         return false;
    }
       
}