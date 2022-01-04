const expresionesRegulares = {
    //idProveedor: /^PROV+-[0-9]{3}[A-Z]{3}$/, //Esto puede cambiar Por ahora está para que empieze como PROV-(esto a la de ahuevo) despues 3 números 3 letras
    nombreProveedor:/^[A-Z][a-zÀ-ÿ\s]/, //Letras y espacios, pueden llevar acentos  ----Los nombres solo pueden iniciar con mayusculas. /^[A-Z][a-z]{2,25}$/,
    ApellidoPProveedor:/^[A-Z][a-zÀ-ÿ]{2,25}$/, //Los nombres solo pueden iniciar con mayusculas.
    ApellidoMProveedor:/^[A-Z][a-zÀ-ÿ]{2,25}$/, //Los nombres solo pueden iniciar con mayusculas.
    NumTelefono:/^[0-9]{10}$/, //Los números de telefono tiene 10 números
    Correo:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,   // Correo electrónico
    Calle: /^[A-Z][a-zÀ-ÿ\s]{1,40}/, //Letras y espacios, pueden llevar acentos
    NumExt:/^[0-2]+[0-9][0-9]$/, // Números exteriores 
    //(([A-Z]+[a-z]+[0-9]+)|([A-Z]*[a-z]*[0-9]*))+
};

validator([
    //Empezamos con los imputs del modal ingresar nuevo prov
    [document.getElementById("inputNombreProveedor"), expresionesRegulares.nombreProveedor],
    [document.getElementById("inputApellidoPProveedor"), expresionesRegulares.ApellidoPProveedor],
    [document.getElementById("inputApellidoMProveedor"), expresionesRegulares.ApellidoMProveedor],
    [document.getElementById("inputNumTelefono"), expresionesRegulares.NumTelefono],
    [document.getElementById("inputCorreo"), expresionesRegulares.Correo],
    [document.getElementById("inputCalle"), expresionesRegulares.Calle],
    [document.getElementById("inputNumExt"), expresionesRegulares.NumExt],
    [document.getElementById("inputEstado"), "0"],
    [document.getElementById("idMunicipio"), "0"],
    [document.getElementById("idColonia"), "0"],
    //Continuamos con los Imputs del modal para editar al proveedor
    [document.getElementById("inputNombreProveedorEditar"), expresionesRegulares.nombreProveedor],
    [document.getElementById("inputApellidoPProveedorEditar"), expresionesRegulares.nombreProveedor],
    [document.getElementById("inputApellidoMProveedorEditar"), expresionesRegulares.nombreProveedor],
    [document.getElementById("inputNumTelefonoEditar"), expresionesRegulares.NumTelefono],
    [document.getElementById("inputCorreoEditar"), expresionesRegulares.Correo],
    [document.getElementById("inputCalleEditar"), expresionesRegulares.Calle],
    [document.getElementById("inputNumExtEditar"), expresionesRegulares.NumExt],
    [document.getElementById("inputEstadoEditar"), "0"],
    [document.getElementById("idMunicipioEditar"), "0"],
    [document.getElementById("idColoniaEditar"), "0"],
]);
