/**
 * Todo este codigo debe de ir en archivo aparte :v
 * pero lo puse aqui no mas para probar
 *
 */
const formulariosBorrar = document.getElementsByClassName('form-detele');
let cuerpoModalInformacion = document.querySelector('#confirmacionModal .modal-body')
let FORMULARIO_GLOBAL = null;

for (let index = 0; index < formulariosBorrar.length; index++) {
    const formulario = formulariosBorrar[index];
    //Agregamos el vento de submit a cada "formulario" de las filas 
    //en los registros de la tabla
    formulario.addEventListener('submit',(event)=>{
        event.preventDefault();//Evitamos que el formulario envie cosas.
        const filaHTML = event
                            .target
                            .parentNode
                            .parentNode;
        const registros = filaHTML.getElementsByClassName('data');
       
        //Colocar la informacion en el modal.
        for (let index = 0; index < registros.length; index++) {
            //registros[index];
            const filaBooststrap = document.createElement("div");
            filaBooststrap.classList.add('row');//Agregamos la clase de booststrap

            const columnaCampo = document.createElement("div");
            columnaCampo.classList.add('col-6');
            columnaCampo.innerText = 'CampoNombre:'

            const columnaInformacion = document.createElement("div");
            columnaInformacion.classList.add('col-6');
            columnaInformacion.innerText = registros[index].innerHTML;
            
            filaBooststrap.appendChild(columnaCampo);
            filaBooststrap.appendChild(columnaInformacion);
            
            cuerpoModalInformacion.appendChild(filaBooststrap);
        }
        FORMULARIO_GLOBAL = event.target;
        //console.log(cuerpoModalInformacion);
    });


}

let botonModalConfirmacion = document.getElementById('botonModalConfirmacion');
botonModalConfirmacion.addEventListener('click',event=>{
    console.log(FORMULARIO_GLOBAL);
    FORMULARIO_GLOBAL.submit();
    FORMULARIO_GLOBAL = null;
});