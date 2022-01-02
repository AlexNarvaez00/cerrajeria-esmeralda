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

const evaluarValor = (event, valorDefecto) => {
    if (event.target.value != valorDefecto) {
        event.target.classList.add("is-valid");
        event.target.classList.remove("is-invalid");
    } else {
        event.target.classList.add("is-invalid");
        event.target.classList.remove("is-valid");
    }
};

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

            let elemento = fila[0];
            //Preguntamos que tipo de elemento es.
            switch (fila[0].tagName) {
                case "INPUT":
                    let expresion = fila[1];
                    elemento.addEventListener("keyup", (event) =>
                        evaluarExpre(event, expresion)
                    );
                    // input.addEventListener("focus", (event) =>
                    //     evaluarExpre(event, expresion)
                    // );
                    elemento.addEventListener("blur", (event) =>
                        evaluarExpre(event, expresion)
                    );
                    break;
                case "SELECT":
                    let valorDefecto = fila[1];
                    // elemento.addEventListener("focus", (event) =>
                    //     evaluarExpre(event, valorDefecto)
                    // );
                    elemento.addEventListener("blur", (event) =>
                        evaluarValor(event, valorDefecto)
                    );
                    elemento.addEventListener("change", (event) =>
                        evaluarValor(event, valorDefecto)
                    );
                    break;
            }
        }
    }
};
