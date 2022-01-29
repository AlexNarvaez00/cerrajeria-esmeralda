//Constantes del HTML

let arregloBotonesMostrar = document.getElementsByClassName(
    "btn-information-sales"
);
const modal = document.getElementById("InformacionModalProductos");

const createRowOfInformation = (title, information) => {
    const classOfComponentFather = ["row"];
    const classOfComponentTitle = ["fw-bold", "col-md-3"];
    const classOfComponentInformation = ["col-md-8"];

    let componentFather = document.createElement("section");
    componentFather.classList.add(classOfComponentFather);

    let componentTitle = document.createElement("p");
    componentTitle.innerText = title;
    classOfComponentTitle.forEach((e) => componentTitle.classList.add(e));
    componentFather.appendChild(componentTitle);

    let componentInformation = document.createElement("p");
    componentInformation.innerText = information;
    classOfComponentInformation.forEach((e) =>
        componentInformation.classList.add(e)
    );
    componentFather.appendChild(componentInformation);

    return componentFather;
};

//Funcion para los botones.
const cargarInformacion = async (event) => {
    let dataButton = null;

    if (event.target.nodeName == "SPAN") {
        dataButton = event.target.parentElement.dataset;
    } else {
        dataButton = event.target.dataset;
    }

    let modalBody = modal.querySelector(".container-information");
    modalBody.innerHTML = "";

    //Componenten de cargo dela informacion
    modalBody.innerHTML = `<div class="container-fluid d-flex justify-content-center">
                                <div class="spinner-border text-warning" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>`;

    let peticion = await fetch(dataButton.urlQuery);
    let data = await peticion.json();
    modalBody.innerHTML = "";
    if (data.length == 0) {
        modalBody.innerText = "No se han encontrado resgistros";
    }
    for (let index = 0; index < data.length; index++) {
        const informacionProdcutos = data[index];
        //console.log(informacionProdcutos);
        let divNuevo = document.createElement("div");
        divNuevo.appendChild(
            createRowOfInformation(
                "Nombre del producto:",
                informacionProdcutos.nombre_producto
            )
        );
        divNuevo.appendChild(
            createRowOfInformation("Cantidad:", informacionProdcutos.cantidad)
        );
        divNuevo.appendChild(
            createRowOfInformation(
                "Cantidad en existencia:",
                informacionProdcutos.cantidad_existencia
            )
        );
        divNuevo.appendChild(
            createRowOfInformation(
                "Clasificacion:",
                informacionProdcutos.clasificacion
            )
        );
        modalBody.appendChild(divNuevo);
    }
};

//-> Agregamos el vento a los botones.
for (let index = 0; index < arregloBotonesMostrar.length; index++) {
    const boton = arregloBotonesMostrar[index];
    boton.addEventListener("click", cargarInformacion);
}
