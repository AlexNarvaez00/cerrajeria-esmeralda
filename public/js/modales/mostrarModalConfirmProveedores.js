/**
 * @author Roberto Alejandro Vásquez Alcántara
 */

/*
     | ------------------------------
     | mostrarModalConfirmProveedores
     | ------------------------------
     | Este Script es utilizado para recuperar la información de la vista
     | y poder mostrar la información en un modal del proveedor a borrar.
     | Este modal o la acción continuará cuando demos click al boton confirmar
     |
     */

const formulariosBorrar = document.getElementsByClassName("form-detele");
let cuerpoModalInformacion = document.querySelector("#confirmacionModal .modal-body");
let FORMULARIO_GLOBAL = null;

for (let index = 0; index < formulariosBorrar.length; index++) {
    const formulario = formulariosBorrar[index];
    //Agregamos el vento de submit a cada "formulario" de las filas 
    //en los registros de la tabla
    formulario.addEventListener("submit",(event)=>{
        event.preventDefault();//Evitamos que el formulario envie cosas.
        cuerpoModalInformacion.innerHTML = "";
        const data = event.target[2];
        let informacion = data.dataset;
        let registros = [
            ["ID: ", informacion.id],
            ["Nombre: ", informacion.nombre],
            ["Apellido P: ", informacion.apellidop],
            ["Apellido M: ", informacion.apellidom],
            ["Teléfono: ", informacion.numtelefono],
            ["Correo: ", informacion.correo],
            ["Dirección: ", informacion.direccion]
        ];
       
        //Colocar la informacion en el modal.
        for (let index = 0; index < registros.length; index++) {
            //registros[index];
            const filaBooststrap = document.createElement("div");
            filaBooststrap.classList.add("row");//Agregamos la clase de booststrap

            const columnaCampo = document.createElement("div");
            columnaCampo.classList.add("col-2");
            columnaCampo.classList.add("fw-bolder");
            columnaCampo.innerText = registros[index][0];

           const columnaInformacion = document.createElement("div");
            columnaInformacion.classList.add("col-8");
            columnaInformacion.innerText = registros[index][1];
            
            filaBooststrap.appendChild(columnaCampo);
            filaBooststrap.appendChild(columnaInformacion);
            
            cuerpoModalInformacion.appendChild(filaBooststrap);
        }
        FORMULARIO_GLOBAL = event.target;
        //console.log(cuerpoModalInformacion);
    });
}

/**
 * El formulario se enviara cuando le demos click o boton de confirmacion
 */
let botonModalConfirmacion = document.getElementById("botonModalConfirmacion");
botonModalConfirmacion.addEventListener("click", (event) => {
    FORMULARIO_GLOBAL.submit();
    FORMULARIO_GLOBAL = null;
});