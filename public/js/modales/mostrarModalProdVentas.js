const formulariosAgregarCarrito =
    document.getElementsByClassName("form-carrito");

let cuerpoModalInformacion = document.querySelector(
    "#agregarcarritoModal .modal-body"
);
const leteroProducto = document.getElementById("letreroNombre");

let FORMULARIO_GLOBAL = null;

for (let index = 0; index < formulariosAgregarCarrito.length; index++) {
    const productoCarrito = formulariosAgregarCarrito[index];
    //Agregamos el vento de submit a cada "formulario" de las filas
    //en los registros de la tabla
    productoCarrito.addEventListener("submit", (event) => {
        event.preventDefault(); //Evitamos que el formulario envie cosas.
        const filaHTML = event.target.parentNode.parentNode;
        const registros = filaHTML.getElementsByClassName("dato");
        letreroNombre.innerHTML = "Nombre: " + registros[1].innerHTML;
        FORMULARIO_GLOBAL = event.target;
    });
}

let botonModalConfirmacion = document.getElementById("botonModalConfirmacion");
botonModalConfirmacion.addEventListener("click", (event) => {
    alert(FORMULARIO_GLOBAL);
    //FORMULARIO_GLOBAL.submit();
    //FORMULARIO_GLOBAL = null;
});
