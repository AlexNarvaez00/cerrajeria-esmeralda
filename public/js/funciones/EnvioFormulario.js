/**
 * @param query Consulta del Query selector
 * @param queryButton Id del boton que enviara el formulario
 *
 */
const sendForm = (query, queryButton, cancelado) => {
    let form = document.querySelector(query);
    if (!cancelado) {
        let buttonSend = document.querySelector(queryButton);
        buttonSend.addEventListener("click", (e) => {
            form.submit();
        });
    }
};
