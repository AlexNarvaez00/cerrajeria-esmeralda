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
    //[document.getElementById("inputCorreo"), expresionesRegulares.correo],
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
 * Estra funcion comprueba que el correo sea unico, si ya existe en la base de datos genera un error
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

    var tooltip = new bootstrap.Tooltip(event.target, {
        title: "El correo ya esta en uso"
    });
    tooltip.disable();

    if (data.exist) {
        //Si el usario existe el input se pone de rojo
        event.target.classList.add("is-invalid");
        event.target.classList.remove("is-valid");
        event.target.title = "El correo ya esta en uso";
        tooltip.enable();
        tooltip.show();
    } else {
        //Si no, se queda en verde
        event.target.classList.add("is-valid");
        event.target.classList.remove("is-invalid");
        tooltip.hide();
        tooltip.disable();
    }
    tooltip.dispose();
};
let inputCorreo = document.getElementById("inputCorreo"); 
let inputCorreoEditar = document.getElementById("inputCorreoEditar");

inputCorreo.addEventListener("keyup", verificarCorreo);
inputCorreo.addEventListener("blur", event=>{
    var tooltip = new bootstrap.Tooltip(event.target, {});
    tooltip.hide();
    tooltip.disable();
    tooltip.dispose();
});
inputCorreoEditar.addEventListener("blur", (e) => {
    let valuePrimary = document.getElementById("urlTemp").value;
    valuePrimary = valuePrimary.replace(document.location.href + "/", "");
    verificarCorreo(e,valuePrimary);
});

//------------------Input de la contraseña---------------------------------------------------------------------------------

let inputContraseniaConfirm = document.getElementById(
    "inputPasswordUsuarioCon"
);
let inputContrasenia = document.getElementById("inputPasswordUsuario");

//Las contraseñas nnos las validad la de los correo lo voy a hace diferente alv ya me arte

// inputContraseniaConfirm.addEventListener('keyup',e=>{
//     let value = e.target.value;
//     e.target.title="Las constraseñas con coinciden";
//     var tooltip = new bootstrap.Tooltip(e.target, {
//         title: "Las constraseñas con coinciden"
//     });
//     if(value != inputContrasenia.value){
//         //Las constraseñas son diferentes
//         e.target.classList.add("is-invalid");
//         e.target.classList.remove("is-valid");
//     }else{
//         //Las constraseñas son iguales
//         e.target.classList.add("is-valid");
//         e.target.classList.remove("is-invalid");
//         tooltip.hide();
//         tooltip.disable();
//     }
// });

// inputContraseniaConfirm.addEventListener('blur',e=>{
//     let value = e.target.value;
//     if(value != inputContrasenia.value){
//         e.target.classList.add("is-invalid");
//         e.target.classList.remove("is-valid");
//     }
//     var tooltip = new bootstrap.Tooltip(e.target, {});
//     tooltip.hide();
//     tooltip.disable();
// });
