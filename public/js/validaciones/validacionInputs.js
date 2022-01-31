/**
 * Definimos la funcion que evaluara la expresion regular.
 *
 * @param {Object} element Elemento del html (input) al que le aplicaremos la expresion regular.
 * @param {String} expresion Expresion regular a evaluar
 */
const evaluarExpre = (element, expresion, tooltip) => {
    let cadena = element.target.value; //Optenemos el valor del input
    if (expresion.test(cadena)) {
        //Si la expresion coincide, se pone en verde
        element.target.classList.add("is-valid");
        element.target.classList.remove("is-invalid");
        if (tooltip) {
            tooltip.hide();
            tooltip.disable();
        }
    } else {
        //Agregamos una lista al input para que se ponga en rojo
        element.target.classList.add("is-invalid");
        element.target.classList.remove("is-valid");
        if (tooltip) {
            tooltip.enable();
            tooltip.show();
        }
    }
};
/**
 * Funcion que evala si la opcion seleccionada no es la opcion por defecto
 *
 * @param {Object} event Evento disparado por escuchador de eventos.
 * @param {String} valorDefecto Valor por defecto del elemento "select"
 */
const evaluarValor = (event, valorDefecto, tooltip) => {
    if (event.target.value != valorDefecto) {
        event.target.classList.add("is-valid");
        event.target.classList.remove("is-invalid");
        if (tooltip) {
            tooltip.hide();
            tooltip.disable();
        }
    } else {
        event.target.classList.add("is-invalid");
        event.target.classList.remove("is-valid");
        if (tooltip) {
            tooltip.enable();
            tooltip.show();
        }
    }
};

const limitValidator = (event, limite) => {
    console.log(event.key);
    if (event.target.value.length > limite) {
        event.preventDefault();
    }
};
/**
 * Funcion a para agregar las validaciones en cada uno de los inputs
 * de los formularios
 *
 * @param {Obhject[][]} matrizElementoExpresion
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
            let tooltip = new bootstrap.Tooltip(elemento, {});
            if (tooltip) {
                tooltip.disable();
            }
            //Preguntamos que tipo de elemento es.
            switch (fila[0].tagName) {
                case "INPUT":
                    let expresion = fila[1];
                    elemento.addEventListener("keyup", (event) =>
                        evaluarExpre(event, expresion, tooltip)
                    );
                    // input.addEventListener("focus", (event) =>
                    //     evaluarExpre(event, expresion)
                    // );
                    elemento.addEventListener("blur", (event) =>
                        evaluarExpre(event, expresion, tooltip)
                    );

                    if (fila[2]) {
                        //Limite de caracteres en los inpust
                        elemento.addEventListener("keypress", (e) =>
                            validator(e, fila[2])
                        );
                    }
                    break;
                case "SELECT":
                    let valorDefecto = fila[1];
                    // elemento.addEventListener("focus", (event) =>
                    //     evaluarExpre(event, valorDefecto)
                    // );
                    elemento.addEventListener("blur", (event) =>
                        evaluarValor(event, valorDefecto, tooltip)
                    );
                    elemento.addEventListener("change", (event) =>
                        evaluarValor(event, valorDefecto, tooltip)
                    );
                    break;
            }
        }
    }
};
