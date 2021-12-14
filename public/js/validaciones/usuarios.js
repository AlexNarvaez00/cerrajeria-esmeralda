//Esto es un objeto, bueno, una manera de hacerlos
const expresionesRegulares = {
    idUsuario: /^USU-[0-9]{3}$/, //Esto puede cambiar
    nombreUsuario: /^[A-Z][a-z]{2,14}$/, //Los nombres solo pueden iniciar con mayusculas.
    password: /^[A-Za-z0-9\_]{8,14}$/, //Contraseñas

    //(([A-Z]+[a-z]+[0-9]+)|([A-Z]*[a-z]*[0-9]*))+
};

//Optenemos los input del formulario
const inputIDusuario = document.getElementById("inputIDUsuario");
const inputNombreUsuario = document.getElementById("inputNombreUsuario");
const inputPasswordUsuario = document.getElementById("inputPasswordUsuario");
const inputPasswordUsuarioCon = document.getElementById(
    "inputPasswordUsuarioCon"
);
const inputRolUsuario = document.getElementById('inputRolUsuario');


//Definimos la funcion que evaluara la expresion regular.
function evaluar(element, expresion) {
    let cadena = element.target.value; //Optenemos el valor del input
    if (expresion.test(cadena)) {
        //Si la expresion coincide, se pone en verde
        element.target.classList.add("is-valid");
        element.target.classList.remove("is-invalid");
    } else {
        //Agregamos una lista al input para que se ponga en rojo
        element.target.classList.add("is-invalid");
        element.target.classList.remove("is-valid");
    }
}

//Agregamos el vento escuchador "cuando una tecla se levanta"
inputIDusuario.addEventListener("keyup", (e) =>
    evaluar(e, expresionesRegulares.idUsuario)
);
inputNombreUsuario.addEventListener("keyup", (e) =>
    evaluar(e, expresionesRegulares.nombreUsuario)
);
inputPasswordUsuario.addEventListener("keyup", (e) =>
    evaluar(e, expresionesRegulares.password)
);
inputPasswordUsuarioCon.addEventListener("keyup", (e) =>
    evaluar(e, expresionesRegulares.password)
);

inputRolUsuario.addEventListener('change',(e)=>{
    if(e.target.value != 0){
        e.target.classList.add('is-valid')
        e.target.classList.remove('is-invalid')
    }else{
        e.target.classList.add('is-invalid')
        e.target.classList.remove('is-valid')
    }
})
//======================Eventos que se ejecutara el modal ============================================



// const modal = document.getElementById('registroUsuariosModal');

// const resetInputs = (e) =>{
//     let inputValidos = e.target.getElementsByClassName('is-valid'); 
//     for (let index = 0; index < inputValidos.length; index++) {
//         const input = inputValidos[index];
//         input.classList.remove('is-valid');
//         input.value = '';

//         if(input.classList.contains('is-invalid')){
//             input.classList.remove('is-invalid')
//         }
//     }
// }
// modal.addEventListener('hidden.bs.modal',resetInputs);
// modal.addEventListener('hidePrevented.bs.modal',resetInputs);

