    $(document).ready(function(){
        alert("Hola Mundo");
    });
    /*const formulariosAgregarCarrito = document.getElementsByClassName('form-carrito'); //Recupera todos los form-carritos de la lista                 
        let cuerpoModalInformacion = document.querySelector('#agregarcarritoModal .modal-body'); //Recuper el cuerpo del modal
        let FORMULARIO_GLOBAL = null;
        for (let index = 0; index < formulariosAgregarCarrito.length; index++) {
            document.getElementById('letreroNombre').innerHTML = 'Hola :3'; 
            //console.log(document.getElementById('letreroNombre').innerHTML);           
            const productoCarrito = formulariosAgregarCarrito[index];
            //Agregamos el vento de submit a cada "formulario" de las filas 
            //en los registros de la tabla
            productoCarrito.addEventListener('submit',(event)=>{                
                event.preventDefault();//Evitamos que el formulario envie cosas.
                const filaHTML = event
                                    .target
                                    .parentNode
                                    .parentNode
                                    .parentNode;
                const registros = filaHTML.getElementsByClassName('dato');                 
                document.getElementById('letreroNombre').innerHTML = 'Nombre del producto: ' + registros[1].innerHTML;
                console.log(document.getElementById('letreroNombre'));
                //Colocar la informacion en el modal.
                for (let index = 0; index < registros.length; index++) {
                    registros[index];
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
            });

        }

*/