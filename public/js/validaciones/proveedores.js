const expresionesRegulares = {
    //idProveedor: /^PROV+-[0-9]{3}[A-Z]{3}$/, //Esto puede cambiar Por ahora está para que empieze como PROV-(esto a la de ahuevo) despues 3 números 3 letras
    nombreProveedor:/^[A-Z][a-zÀ-ÿ\s]/, //Letras y espacios, pueden llevar acentos  ----Los nombres solo pueden iniciar con mayusculas. /^[A-Z][a-z]{2,25}$/,
    ApellidoPProveedor:/^[A-Z][a-zÀ-ÿ]{2,25}$/, //Los nombres solo pueden iniciar con mayusculas.
    ApellidoMProveedor:/^[A-Z][a-zÀ-ÿ]{2,25}$/, //Los nombres solo pueden iniciar con mayusculas.
    NumTelefono:/^[0-9]{10}$/, //Los números de telefono tiene 10 números
    Correo:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,   // Correo electrónico
    Calle: /^[A-Z][a-zÀ-ÿ\s]{1,40}/, //Letras y espacios, pueden llevar acentos
    NumExt:/^[0-2]+[0-9][0-9]$/, // Números exteriores del 0 al 255 pedo del omar >:V
    //(([A-Z]+[a-z]+[0-9]+)|([A-Z]*[a-z]*[0-9]*))+
};

//Optenemos los input del formulario
const inputNombreProveedor = document.getElementById('inputNombreProveedor');
const inputApellidoPProveedor = document.getElementById('inputApellidoPProveedor');
const inputApellidoMProveedor = document.getElementById('inputApellidoMProveedor');
const inputNumTelefono = document.getElementById('inputNumTelefono');
const inputCorreo = document.getElementById('inputCorreo');
const inputCalle = document.getElementById('inputCalle');
const inputNumExt = document.getElementById('inputNumExt');

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
inputNombreProveedor.addEventListener('keyup',e => evaluar(e,expresionesRegulares.nombreProveedor));
inputApellidoPProveedor.addEventListener('keyup',e => evaluar(e,expresionesRegulares.ApellidoPProveedor));
inputApellidoMProveedor.addEventListener('keyup',e => evaluar(e,expresionesRegulares.ApellidoMProveedor));
inputNumTelefono.addEventListener('keyup',e => evaluar(e,expresionesRegulares.NumTelefono));
inputCorreo.addEventListener('keyup' ,e => evaluar(e,expresionesRegulares.Correo));
inputCalle.addEventListener('keyup' ,e => evaluar(e,expresionesRegulares.Calle));
inputNumExt.addEventListener('keyup' , e => evaluar(e,expresionesRegulares.NumExt));