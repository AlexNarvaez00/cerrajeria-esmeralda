/**
 *  Definimos la funcion que evaluara la expresion regular.
 */
const evaluarExpre = (element, expresion) => {
    let cadena = element.target.value; //Optenemos el valor del input
    if (expresion.test(cadena)) {
        //Si la expresion coincide, se pone en verde
        element.target.classList.add("is-valid");
        element.target.classList.remove("is-invalid");
    } else {
        //Agregamos una lista al input para que se ponga en rojo
        element.target.classList.add("is-invalid");
        element.target.classList.remove("is-valid");
    }
};

const evaluarValor = (event,valorDefecto) =>{
    if(event.target.value != valorDefecto){
        
    }
}


/**
 * Funcion a para agregar las validaciones en cada uno de los inputs
 * de los formularios
 *
 * @param var matrizElementoExpresion
 *  El formato debe ser
 *      [document.getElementById('ID'),/[A-Z]/ ] -> Es solo el ejemplo
 *
 *
 */
const validator = (matrizElementoExpresion) => {
    for (let index = 0; index < matrizElementoExpresion.length; index++) {
        const fila = matrizElementoExpresion[index];

        if (fila[0]) {
            //Si el elemento existe

            //Preguntamos que tipo de elemento es.
            switch (fila[0].tagName) {
                case "INPUT":
                    let input = fila[0];
                    let expresion = fila[1];
                    input.addEventListener("keyup", (event) =>
                        evaluarExpre(event, expresion)
                    );
                    input.addEventListener("focus", (event) =>
                        evaluarExpre(event, expresion)
                    );
                    input.addEventListener("blur", (event) =>
                        evaluarExpre(event, expresion)
                    );
                    break;
                case "SELECT":
                    let select = fila[0];
                    select.addEventListener("focus", (event) =>
                        evaluarExpre(event, expresion)
                    );
                    select.addEventListener("blur", (event) =>
                        evaluarExpre(event, expresion)
                    );
                    break;
            }
        }
    }
};
