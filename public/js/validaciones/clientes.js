const expresionesRegulares = {
    nombreCliente:/^[A-Z][a-zÀ-ÿ\s]/,
    ApellidoPCliente:/^[A-Z][a-zÀ-ÿ]{2,25}$/, 
    ApellidoMCliente:/^[A-Z][a-zÀ-ÿ]{2,25}$/, 
    Telefono:/^[0-9]{10}$/,
};

//Optenemos los input del formulario
const inputNombreCliente = document.getElementById('inputNombreCliente');
const inputApellidoPCliente = document.getElementById('inputApellidoPCliente');
const inputApellidoMCliente = document.getElementById('inputApellidoMCliente');
const inputNumTelefono = document.getElementById('inputNumTelefono');

const inputNombreClienteEditar = document.getElementById('inputNombreClienteEditar');
const inputApellidoPClienteEditar = document.getElementById('inputApellidoPClienteEditar');
const inputApellidoMClienteEditar = document.getElementById('inputApellidoMClienteEditar');
const inputNumTelefonoEditar = document.getElementById('inputNumTelefonoEditar');

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
inputNombreCliente.addEventListener('keyup',e => evaluar(e,expresionesRegulares.nombreCliente));
inputApellidoPCliente.addEventListener('keyup',e => evaluar(e,expresionesRegulares.ApellidoPCliente));
inputApellidoMCliente.addEventListener('keyup',e => evaluar(e,expresionesRegulares.ApellidoMCliente));
inputNumTelefono.addEventListener('keyup',e => evaluar(e,expresionesRegulares.Telefono));

inputNombreClienteEditar.addEventListener('keyup',e => evaluar(e,expresionesRegulares.nombreCliente));
inputApellidoPClienteEditar.addEventListener('keyup',e => evaluar(e,expresionesRegulares.ApellidoPCliente));
inputApellidoMClienteEditar.addEventListener('keyup',e => evaluar(e,expresionesRegulares.ApellidoMCliente));
inputNumTelefonoEditar.addEventListener('keyup',e => evaluar(e,expresionesRegulares.Telefono));