let botonesEditar = document.getElementsByClassName('boton-editar');

//Funcion flecha
const mostarInformacion = (e) =>{
    let boton = e.target;
    
    if(boton.tagName.toLowerCase() == 'span'){
        boton = boton.parentElement;
    }
    //let fomularioEnvio = document.getElementById('registroUsuariosModal');
    
    let inputIdUsuario = document.getElementById('inputIDUsuario');
    let inputNombreUsuario = document.getElementById('inputNombreUsuario');
    let inputRol = document.getElementById('inputRolUsuario');


    inputIdUsuario.value = boton.dataset.id;
    
    inputNombreUsuario.value = boton.dataset.nombre; 
    inputNombreUsuario.classList.add('is-valid');
    
    inputRol.value = boton.dataset.rol; 
    inputRol.classList.add('is-valid');

};

//Agregamos la funciona  los eventos.
for (let index = 0; index < botonesEditar.length; index++) {
    const boton = botonesEditar[index];
    boton.addEventListener('click',mostarInformacion);
}

