 //Esto es un objeto, bueno, una manera de hacerlos
 const expresionesRegulares = {
    idUsuario: /^USU-[0-9]{3}$/, //Esto puede cambiar
    nombreUsuario:/^[A-Z][a-z]{2,14}$/, //Los nombres solo pueden iniciar con mayusculas.
    password: /^[A-Za-z0-9\_]{8,14}$/ //Contraseñas

    //(([A-Z]+[a-z]+[0-9]+)|([A-Z]*[a-z]*[0-9]*))+
};

//Optenemos los input del formulario
const inputIDusuario = document.getElementById('inputIDUsuario');
const inputNombreUsuario = document.getElementById('inputNombreUsuario');
const inputPasswordUsuario = document.getElementById('inputPasswordUsuario');
const inputPasswordUsuarioCon = document.getElementById('inputPasswordUsuarioCon');

//Definimos la funcion que evaluara la expresion regular.
function evaluar(element,expresion){
    let cadena = element.target.value;//Optenemos el valor del input
    if(expresion.test(cadena)){
        //Si la expresion coincide, se pone en verde
        element.target.classList.add('is-valid') 
        element.target.classList.remove('is-invalid')  
    }else{
        //Agregamos una lista al input para que se ponga en rojo
        element.target.classList.add('is-invalid')
        element.target.classList.remove('is-valid')    
    }      
}

//Agregamos el vento escuchador "cuando una tecla se levanta"
inputIDusuario.addEventListener('keyup',e => evaluar(e,expresionesRegulares.idUsuario));
inputNombreUsuario.addEventListener('keyup',e => evaluar(e,expresionesRegulares.nombreUsuario));
inputPasswordUsuario.addEventListener('keyup',e => evaluar(e,expresionesRegulares.password));
inputPasswordUsuarioCon.addEventListener('keyup',e => evaluar(e,expresionesRegulares.password));