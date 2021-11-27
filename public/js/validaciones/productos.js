 //Esto es un objeto, bueno, una manera de hacerlos
 const expresionesRegulares = {
    claveProducto: /[\w]{10}/

    
};

//Optenemos los input del formulario
const inputClaveProducto = document.getElementById('inClaveProducto');
const inputNomProducto = document.getElementById('inNomProducto');
const inputClasificacion = document.getElementById('inClasificacion');
const inputPrecio = document.getElementById('inPrecio');
const inputCantExistencia = document.getElementById('inCantExistencia');

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
inputClaveProducto.addEventListener('keyup',e => evaluar(e,expresionesRegulares.claveProducto));
