const botonResumir = document.getElementById("btn-resumir");
const bodyModalResumen = document.querySelector(
    "#InformacionResumida .container-information"
);


const colocarResultados = async (e) => {
    let selectorMes = document.getElementById("inputSelectorMes");
    let selectorAnio = document.getElementById("inputSelectorAnio");

    let mes = selectorMes.value;
    let anio = selectorAnio.value;

    if (mes == 0 && anio == 0) return;
    //document.location.origin      -> 'http://127.0.0.1:8000'
    //document.location.pathname    -> '/reporte-ventas-servicios'
    let URL = `${document.location.origin}${document.location.pathname}/servicios/por/${mes}/${anio}`;
    let peticionFecth = await fetch(URL);
    let datos = await peticionFecth.json();

    //Intepretacion de los resultados.
    if (mes != "0" && anio != "0") {
        //selecciono ambos
        let p = document.createElement('p');
        //p.classList.add(''); 
        p.innerHTML = `Reporte del mes de ${mes} del año ${anio}`;

        bodyModalResumen.appendChild(p);
        return;
    }
    if (mes != "0") {
        //Selecciono el mes
        return;
    }
    if (anio != "0") {
        //Selecciono el anio
        // Necesiatamos hace la consulta a por año
        return;
    }
};

botonResumir.addEventListener("click", colocarResultados);
