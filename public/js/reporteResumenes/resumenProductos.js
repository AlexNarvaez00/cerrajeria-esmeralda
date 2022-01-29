const botonResumir = document.getElementById("btn-resumir");
const bodyModalResumen = document.querySelector(
    "#InformacionResumida .container-information"
);
const meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abrirl",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
];


const createRow = (rowDB) => {
    //Creamos un TR
    let tr = document.createElement("tr");
    //Creamos lo TDS
    let tds = [
        document.createElement("td"), //0
        document.createElement("td"), //1
        document.createElement("td"), //2
        document.createElement("td"), //3
        document.createElement("td"), //4
    ];
    tds[0].innerHTML = rowDB.nombre_producto;
    tds[1].innerHTML = rowDB.observaciones;
    tds[2].innerHTML = rowDB.clasificacion;
    tds[3].innerHTML = rowDB.precio_producto;
    tds[4].innerHTML = rowDB.cantidad;

    tds.forEach((td) => {
        tr.appendChild(td);
    });
    return tr;
};





const createTable = (datos) => {
    //Tabla para mostrar los de las registro
    let tablaInformacion = document.createElement("table");
    tablaInformacion.classList.add("table");

    //Creamos el encabezado de la tablas
    let tablaInformacionHead = document.createElement("thead");
    tablaInformacion.appendChild(tablaInformacionHead);
    let tablaInformacionHeaders = [
        "nombre_producto",
        "observaciones",
        "clasificacion",
        "precio_producto",
        "cantidad",
    ];
    let tablaInformacionHeadRow = document.createElement("tr");
    tablaInformacionHead.appendChild(tablaInformacionHeadRow);
    tablaInformacionHeaders.forEach((e) => {
        let th = document.createElement("th");
        th.innerHTML = e;
        tablaInformacionHeadRow.appendChild(th);
    });

    //creamos el cuerpo de la tabla
    let tablaInformacionBody = document.createElement("tbody");
    tablaInformacion.appendChild(tablaInformacionBody);

    //Es un arreglo -------------------------
    let informacion = datos.informacion;
    informacion.forEach((element) => {
        tablaInformacionBody.appendChild(createRow(element));
    });

    return tablaInformacion;
};



const colocarResultados = async (e) => {
    bodyModalResumen.innerHTML = "";
    let selectorMes = document.getElementById("inputSelectorMes");
    let selectorAnio = document.getElementById("inputSelectorAnio");

    let mes = selectorMes.value;
    let anio = selectorAnio.value;

    if (mes == 0 && anio == 0) return;
    let URL = `${document.location.origin}${document.location.pathname}/productos/por/${mes}/${anio}`;
    let peticionFecth = await fetch(URL);
    let datos = await peticionFecth.json();
    let p = document.createElement("p");

    if(datos.informacion.length == 0){
        p.innerHTML ="No existen datos para resumir &#x274c;, intenta con otra consulta";
        bodyModalResumen.appendChild(p);
        return 
    }


    //Intepretacion de los resultados.
    if (mes != "0" && anio != "0") {
        //selecciono ambos
        //p.classList.add('');
        p.innerHTML = `Reporte del mes de <span class="fw-bolder">${meses[mes - 1]}</span> del año <span class="fw-bolder">${anio}</span>`;
        bodyModalResumen.appendChild(p);

        let resumen = document.createElement("p");
        resumen.innerHTML = `Las ganancias totales del mes de <span class="fw-bolder">${
            meses[mes - 1]
        }</span> del año <span class="fw-bolder">${anio}</span> son de \$${
            datos.resumen[0].ganancia
        }, con un total de ${
            datos.resumen[0].materialesUtilizados
        } materiales utilizados`;

        bodyModalResumen.appendChild(resumen);
        bodyModalResumen.appendChild(createTable(datos));
        return;
    }
    if (mes != "0") {
        //Selecciono el mes
        //p.classList.add('');
        p.innerHTML = `Reporte del mes de <span class="fw-bolder">${
            meses[mes - 1]
        }</span> de <span class="fw-bolder">TODOS LOS AÑOS DISPONIBLES</span>`;
        bodyModalResumen.appendChild(p);

        let resumen = document.createElement("p");
        resumen.innerHTML = `Las ganancias totales del mes de <span class="fw-bolder">${
            meses[mes - 1]
        } </span> 
        son de \$${datos.resumen[0].ganancia}, con un total de ${
            datos.resumen[0].materialesUtilizados
        } materiales utilizados`;

        bodyModalResumen.appendChild(resumen);
        bodyModalResumen.appendChild(createTable(datos));
    }
    if (anio != "0") {
        //Selecciono el mes
        //p.classList.add('');
        p.innerHTML = `Reporte del año de <span class="fw-bolder">${
            anio
        }</span> de <span class="fw-bolder">TODOS LOS MESES</span>`;
        bodyModalResumen.appendChild(p);

        let resumen = document.createElement("p");
        resumen.innerHTML = `Las ganancias totales del año <span class="fw-bolder">${
            anio
        } </span> 
        son de \$${datos.resumen[0].ganancia}, con un total de ${
            datos.resumen[0].materialesUtilizados
        } materiales utilizados`;

        bodyModalResumen.appendChild(resumen);
        bodyModalResumen.appendChild(createTable(datos));
    }
};

botonResumir.addEventListener("click", colocarResultados);



