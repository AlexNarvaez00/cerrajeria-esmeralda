//Esto es un objeto, bueno, una manera de hacerlos
const expresionesRegulares = {
    idUsuario: /^USU-[0-9]{3}$/, //Esto puede cambiar
    nombreUsuario: /^[A-Z][a-z]{2,14}$/, //Los nombres solo pueden iniciar con mayusculas.
    correo: /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/, //Los nombres solo pueden iniciar con mayusculas.
    password: /^[A-Za-z0-9\_]{8,30}$/, //Contraseñas
};

validator([
    [document.getElementById("inputIDUsuario"), expresionesRegulares.idUsuario],
    [
        document.getElementById("inputNombreUsuario"),
        expresionesRegulares.nombreUsuario,
        20,
    ],
    [document.getElementById("inputCorreo"), expresionesRegulares.correo],
    [
        document.getElementById("inputPasswordUsuario"),
        expresionesRegulares.password,
    ],
    [
        document.getElementById("inputPasswordUsuarioCon"),
        expresionesRegulares.password,
    ],
    [document.getElementById("inputRolUsuario"), "0"], //Esto es un selector
    //Inpust de edicion
    [
        document.getElementById("inputIDUsuarioEditar"),
        expresionesRegulares.idUsuario,
    ],
    [
        document.getElementById("inputNombreUsuarioEditar"),
        expresionesRegulares.nombreUsuario,
    ],
    [document.getElementById("inputCorreoEditar"), expresionesRegulares.correo],
    [
        document.getElementById("inputPasswordUsuarioEditar"),
        expresionesRegulares.password,
    ],
    [
        document.getElementById("inputPasswordUsuarioConEditar"),
        expresionesRegulares.password,
    ],
    [document.getElementById("inputRolUsuarioEditar"), "0"], //El otro selector xd
]);

//-------------------------------------Validacion esta del input del correo--------------------------------------------------------------------
/**
 *
 * @param {Object} event Evento que dispara el input de "correo"
 */
const verificarCorreo = async (event,valuePrimary = '0=0') => {
    const URL = `${document.location.origin}/users/get/`;
    let correo = event.target.value;
    if (!correo) {
        return;
    }
    let promesa = await fetch(URL + correo+'/'+valuePrimary);
    let data = await promesa.json();

    if (data.exist) {
        //Si el usario existe el input se pone de rojo
        event.target.classList.add("is-invalid");
        event.target.classList.remove("is-valid");
        event.target.title = "El correo ya esta en uso";
    } else {
        //Si no, se queda en verde
    }
};
let inputCorreo = document.getElementById("inputCorreo");
let inputCorreoEditar = document.getElementById("inputCorreoEditar");
let emailChange = null;

inputCorreo.addEventListener("blur", verificarCorreo);
inputCorreoEditar.addEventListener("blur", (e) => {
    let valuePrimary = document.getElementById("urlTemp").value;
    valuePrimary = valuePrimary.replace(document.location.href + "/", "");
    verificarCorreo(e,valuePrimary);
});
