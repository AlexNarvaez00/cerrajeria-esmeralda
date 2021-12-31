//Esto es un objeto, bueno, una manera de hacerlos
const expresionesRegulares = {
    idUsuario: /^USU-[0-9]{3}$/, //Esto puede cambiar
    nombreUsuario: /^[A-Z][a-z]{2,14}$/, //Los nombres solo pueden iniciar con mayusculas.
    password: /^[A-Za-z0-9\_]{8,30}$/, //Contraseñas
};

validator([
    [document.getElementById('inputIDUsuario'),expresionesRegulares.idUsuario],
    [document.getElementById('inputNombreUsuario'),expresionesRegulares.nombreUsuario],
    [document.getElementById('inputPasswordUsuario'),expresionesRegulares.password],
    [document.getElementById('inputPasswordUsuarioCon'),expresionesRegulares.password],
    [document.getElementById('inputRolUsuario'),'0'], //Esto es un selector
    //Inpust de edicion
    [document.getElementById('inputIDUsuarioEditar'),expresionesRegulares.idUsuario],
    [document.getElementById('inputNombreUsuarioEditar'),expresionesRegulares.nombreUsuario],
    [document.getElementById('inputPasswordUsuarioEditar'),expresionesRegulares.password],
    [document.getElementById('inputPasswordUsuarioConEditar'),expresionesRegulares.password],
    [document.getElementById('inputRolUsuarioEditar'),'0'], //El otro selector xd
]);