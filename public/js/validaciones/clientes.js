/**
 * @author Santiago Solano Dafne
 */

const expresionesRegulares = {
    nombreCliente:/^[A-Z][a-zÀ-ÿ\s]/,
    ApellidoPCliente:/^[A-Z][a-zÀ-ÿ]{2,25}$/, 
    ApellidoMCliente:/^[A-Z][a-zÀ-ÿ]{2,25}$/, 
    Telefono:/^[0-9]{10}$/,
};
validator([
    [document.getElementById("inputNombreCliente"), expresionesRegulares.nombreCliente],
    [document.getElementById("inputApellidoPCliente"), expresionesRegulares.ApellidoPCliente],
    [document.getElementById("inputApellidoMCliente"), expresionesRegulares.ApellidoMCliente],
    [document.getElementById("inputNumTelefono"), expresionesRegulares.Telefono],
    [document.getElementById("inputNombreClienteEditar"), expresionesRegulares.nombreCliente],
    [document.getElementById("inputApellidoPClienteEditar"), expresionesRegulares.ApellidoPCliente],
    [document.getElementById("inputApellidoMClienteEditar"), expresionesRegulares.ApellidoMCliente],
    [document.getElementById("inputNumTelefonoEditar"), expresionesRegulares.Telefono],
]);
