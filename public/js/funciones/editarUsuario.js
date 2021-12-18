let botonesEditar = document.getElementsByClassName('boton-editar');
const modal = document.getElementById('editarUsuariosModal');

//Funcion flecha
const mostarInformacion = (e) =>{
    //let inputIDUsuario = document.getElementById('inputIDUsuarioEditar');
   
    let data = null;
    if(e.target.nodeName == 'SPAN'){
        data = e.target.parentElement.dataset;
    }else{
        data = e.target.dataset;
    }

    let formulario = modal.getElementsByTagName('form')[0];
    formulario.action = data.routeUrl;

    document.getElementById('inputNombreUsuarioEditar').value = data.nombre;
    document.getElementById('inputRolUsuarioEditar').value = data.rol;
    //console.log(document.getElementById('inputRolUsuarioEditar'))
};

//Agregamos la funciona  los eventos.
for (let index = 0; index < botonesEditar.length; index++) {
    const boton = botonesEditar[index];
    boton.addEventListener('click',mostarInformacion);
}

modal.addEventListener('hide.bs.modal',e=>{
    let inputsValidos = modal.getElementsByClassName('is-valid');
    for (let index = 0; index < inputsValidos.length; index++) {
        inputsValidos[index].classList.remove('is-valid');
    }
});

