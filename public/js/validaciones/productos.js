//Esto es un objeto, bueno, una manera de hacerlos
const expresionesRegulares = {
    claveProducto: /^[a-zA-Z|\-|\d]*$/,
    caracteres: /^[a-zA-Z|-|\s]*$/,
    cantidades: /\d/,
};

//Optenemos los input del formulario
const inputClaveProducto = document.getElementById("inClaveProducto");
const inputNomProducto = document.getElementById("inNomProducto");
const inputClasificacion = document.getElementById("inClasificacion");
const inputPrecio = document.getElementById("inPrecio");
const inputCantExistencia = document.getElementById("inCantExistencia");

//Definimos la funcion que evaluara la expresion regular.
function evaluar(element, expresion) {
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
}
function evaluarNumeros(element, expresion) {
    let cadena = element.target.value;
    if (expresion.test(cadena) && cadena >= 0) {
        element.target.classList.add("is-valid");
        element.target.classList.remove("is-invalid");
    } else {
        element.target.classList.add("is-invalid");
        element.target.classList.remove("is-valid");
    }
}

//Agregamos el vento escuchador "cuando una tecla se levanta"
if (inputClaveProducto) {
    inputClaveProducto.addEventListener("keyup", (e) =>
        evaluar(e, expresionesRegulares.claveProducto)
    );
}
if (inputNomProducto) {
    inputNomProducto.addEventListener("keyup", (e) =>
        evaluar(e, expresionesRegulares.caracteres)
    );
}
if (inputCantExistencia) {
    inputCantExistencia.addEventListener("keyup", (e) =>
        evaluarNumeros(e, expresionesRegulares.cantidades)
    );
}
if (inputPrecio) {
    inputPrecio.addEventListener("keyup", (e) =>
        evaluarNumeros(e, expresionesRegulares.cantidades)
    );
}
if (inputClasificacion) {
    inputClasificacion.addEventListener("keyup", (e) =>
        evaluar(e, expresionesRegulares.caracteres)
    );
}
//Opcion para el boton editar

$(".btnEditar").on("click", function () {
    let fila = $(this).closest("tr").find(".dato");
    var claveproducto = fila[0].innerHTML;
    var claveProveedor = fila[5].innerHTML;

    $("#btnRegistrarProducto").hide();
    $("#btnGuardarCambios").show();
    $("#inClaveProducto").prop("disabled", true);
    $("#inClaveProducto").val(fila[0].innerHTML);
    $("#inNomProducto").val(fila[1].innerHTML);
    $("#inClasificacion").val(fila[2].innerHTML);
    $("#inPrecio").val(fila[3].innerHTML.replace("$", ""));
    $("#inCantExistencia").val(fila[4].innerHTML);

    minAjax({
        url: "/producto/detalles",
        type: "POST",
        data: {
            _token: document.querySelector('input[name="_token"]').value,
            clave_producto: claveproducto,
            idproveedor: claveProveedor,
        },
        success: function (data) {
            data = JSON.parse(data);
            $("#inDescripcion").val(data.data.descripcion.descripcion);
            $(
                "#proveedores option[value=" +
                    data.data.proveedor.idproveedor +
                    "]"
            ).attr("selected", true);
        },
    });
});
//Opción para el boton ver detalles
$(".btnDetalles").on("click", function () {
    let fila = $(this).closest("tr").find(".dato");

    var claveproducto = fila[0].innerHTML;
    var claveProveedor = fila[5].innerHTML;
    $("#detalleClave").val(claveproducto);
    $("#detalleNombreProducto").val(fila[1].innerHTML);
    $("#detalleClasificacion").val(fila[2].innerHTML);
    $("#detallePrecio").val(fila[3].innerHTML);
    $("#detalleExistencia").val(fila[4].innerHTML);
    minAjax({
        url: "/producto/detalles",
        type: "POST",
        data: {
            _token: document.querySelector('input[name="_token"]').value,
            clave_producto: claveproducto,
            idproveedor: claveProveedor,
        },
        success: function (data) {
            data = JSON.parse(data);
            $("#detalleDescripcion").val(data.data.descripcion.descripcion);
            $("#detalleIdProveedor").val(data.data.proveedor.idproveedor);
            $("#detalleNombreProveedor").val(data.data.proveedor.nombre);
            $("#detalleApellidoP").val(data.data.proveedor.apellidopaterno);
            $("#detalleapellidoM").val(data.data.proveedor.apellidomaterno);
            $("#detalleCorreo").val(data.data.proveedor.correo);
            $("#detalledireccion").val(data.data.proveedor.iddirecproveedor);
        },
    });
});

$("#estadoProveedor").on("change", function () {
    let valor = $("#estadoProveedor").val();
    $("#muncipioProveedor").prop("disabled", false);
    $("#muncipioProveedor").find("option").remove();
    $("#muncipioProveedor").append(
        $("<option>", {
            value: 0,
            text: "Seleccione un municipio",
        })
    );
    if (valor != "0") {
        minAjax({
            url: "/municipios/proveedor",
            type: "POST",
            data: {
                _token: document.querySelector('input[name="_token"]').value,
                id: valor,
            },
            success: function (data) {
                data = JSON.parse(data);
                for (let i = 0; i < data.length; i++) {
                    $("#muncipioProveedor").append(
                        $("<option>", {
                            value: data[i].idmunicipio,
                            text: data[i].nombre,
                        })
                    );
                }
            },
        });
    } else {
        $("#muncipioProveedor").prop("disabled", true);
        $("#muncipioProveedor option[value='0']").attr("selected", true);
    }
});
$("#muncipioProveedor").on("change", function () {
    let valor = $("#muncipioProveedor").val();
    $("#coloniaProveedor").prop("disabled", false);
    $("#coloniaProveedor").find("option").remove();
    $("#coloniaProveedor").append(
        $("<option>", {
            value: 0,
            text: "Seleccione una colonia",
        })
    );
    if (valor != "0") {
        minAjax({
            url: "/colonias/proveedor",
            type: "POST",
            data: {
                _token: document.querySelector('input[name="_token"]').value,
                idmunicipio: valor,
            },
            success: function (data) {
                data = JSON.parse(data);
                for (let i = 0; i < data.length; i++) {
                    $("#coloniaProveedor").append(
                        $("<option>", {
                            value: data[i].idcolonia,
                            text:
                                data[i].nombre + " CP:" + data[i].codigopostal,
                        })
                    );
                }
            },
        });
    } else {
        $("#coloniaProveedor").prop("disabled", true);
        $("#coloniaProveedor option[value='0']").attr("selected", true);
    }
});

//Limpiar las entradas para que no quede reciduo
function limpiar() {
    $("#btnRegistrarProducto").show();
    $("#btnGuardarCambios").hide();
    $("#inClaveProducto").val("");
    $("#inClaveProducto").prop("disabled", false);
    $("#inNomProducto").val("");
    $("#inClasificacion").val("");
    $("#inPrecio").val("0.00");
    $("#inCantExistencia").val("0");
    $("#inDescripcion").val("");
}
//Agrega a un nuevo proveedor
$("#formularioProveedor").on("submit", function (e) {
    e.preventDefault();
    var datosFormulario = $(this).serializeArray();
    //alert(datosFormulario);
    minAjax({
        url: "/agrega/proveedor",
        type: "POST",
        data: {
            _token: document.querySelector('input[name="_token"]').value,
            proveedor:datosFormulario.map(e=>`{"name":"${e.name}","value":"${e.value}"}`)
        },        
        success: function(data){   
            data = JSON.parse(data);       
            $("#proveedores").append(
                $("<option>", {
                    value: data.idproveedor,
                    text: data.idproveedor + " "+data.nombre,
                })
            );
            $("#proveedores option[value='"+data.idproveedor+"']").attr("selected", true);
        }
       });
});

