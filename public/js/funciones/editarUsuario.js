let botonesEditar = document.getElementsByClassName('boton-editar');
const modal = document.getElementById('editarUsuariosModal');

/**
 * Coloca los datos que posee el boton en los inputs del formulario.        
 * 
 * @param {Object} e Evento que se dispara al momento de dar click en el boton
 */
const mostarInformacion = (e) =>{
   
    let data = null;
    if(e.target.nodeName == 'SPAN'){
        data = e.target.parentElement.dataset;
    }else{
        data = e.target.dataset;
    }

    let formulario = modal.getElementsByTagName('form')[0];
    formulario.action = data.routeUrl;
    document.getElementById('urlTemp').value = data.routeUrl;

    document.getElementById('inputNombreUsuarioEditar').value = data.nombre;
    document.getElementById('inputRolUsuarioEditar').value = data.rol;
    document.getElementById('inputCorreoEditar').value = data.correo;
};

/**
 * Agregamos la funcion a cada uno de los botones
 */
for (let index = 0; index < botonesEditar.length; index++) {
    const boton = botonesEditar[index];
    boton.addEventListener('click',mostarInformacion);
}

/**
 * Le quitamos todas las clases de "validacion" a los inputs 
 * del formulario
 */
modal.addEventListener('hide.bs.modal',e=>{
    let inputsValidos = modal.getElementsByClassName('is-valid');
    for (let index = 0; index < inputsValidos.length; index++) {
        inputsValidos[index].classList.remove('is-valid');
    }
});

