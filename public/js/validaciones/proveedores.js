/**
 * @author Roberto Alejandro Vásquez Alcántara
 */

    /*
     | ------------------------------
     | proveedores
     | ------------------------------
     | Este Script es utilizado para validar las entradas (imputs, haciendo uso de expresiones
     | regulares en JavaScript) en la vista
     | tanto del formulario para registrar un nuevo proveedor como el formulario
     | para actualizar el registro del proveedor.
     */

     /**
     * Objeto de expresiones regulares para validar los campos en el formulario
     * 
     * @var Object
     */
const expresionesRegulares = {
    nombreProveedor:/^[A-Z][a-zÀ-ÿ\s]/, //Letras y espacios, pueden llevar acentos
    ApellidoPProveedor:/^[A-Z][a-zÀ-ÿ]{2,25}$/, //Los nombres solo pueden iniciar con mayusculas.
    ApellidoMProveedor:/^[A-Z][a-zÀ-ÿ]{2,25}$/, //Los nombres solo pueden iniciar con mayusculas.
    NumTelefono:/^[0-9]{10}$/, //Los números de telefono tiene 10 números
    Correo:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,   // Correo electrónico
    Calle: /^[A-Z][a-zÀ-ÿ\s]{1,40}/, //Letras y espacios, pueden llevar acentos
    NumExt:/^[0-9]{3,4}[A-Z-]{0,3}$/, // Números exteriores 
    NumInt:/^[0-9]{3,4}[A-Z-]{0,3}$/, // Números interiores 
};

validator([
    //Empezamos con los imputs del modal ingresar nuevo proveedor
    [document.getElementById("inputNombreProveedor"), expresionesRegulares.nombreProveedor],
    [document.getElementById("inputApellidoPProveedor"), expresionesRegulares.ApellidoPProveedor],
    [document.getElementById("inputApellidoMProveedor"), expresionesRegulares.ApellidoMProveedor],
    [document.getElementById("inputNumTelefono"), expresionesRegulares.NumTelefono],
    [document.getElementById("inputCorreo"), expresionesRegulares.Correo],
    [document.getElementById("inputCalle"), expresionesRegulares.Calle],
    [document.getElementById("inputNumExt"), expresionesRegulares.NumExt],
    [document.getElementById("inputNumInt"), expresionesRegulares.NumInt],
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
    [document.getElementById("inputNumIntEditar"), expresionesRegulares.NumInt],
    [document.getElementById("inputEstadoEditar"), "0"],
    [document.getElementById("idMunicipioEditar"), "0"],
    [document.getElementById("idColoniaEditar"), "0"],
]);

const verificarCorreo = async (event,valuePrimary = '0=0') => {
    const URL = `${document.location.origin}/proveedores/get/`;
    let correo = event.target.value;
    if (!correo) {
        return;
    }
    let promesa = await fetch(URL + correo+'/'+valuePrimary);
    let data = await promesa.json();

    var tooltip = new bootstrap.Tooltip(event.target, {
        title: "El correo ya esta en uso"
    });
    tooltip.hide();
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
    //tooltip.dispose();
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