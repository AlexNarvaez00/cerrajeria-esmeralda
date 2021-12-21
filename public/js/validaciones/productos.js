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
//Obtiene los valores de las filas

    $(".btnEditar").on('click',function() {
        let fila = $(this).closest("tr").find(".dato");
        $("#btnRegistrarProducto").hide();
        $("#btnGuardarCambios").show();
        $("#inClaveProducto").prop("disabled", true); 
        $("#inClaveProducto").val(fila[0].innerHTML); 
        $("#inNomProducto").val(fila[1].innerHTML);
        $("#inClasificacion").val(fila[2].innerHTML);
        $("#inPrecio").val(fila[3].innerHTML.replace("$","")); 
        $("#inCantExistencia").val(fila[4].innerHTML);   
        
        //alert(fila[0].innerHTML);
        //$("#inClaveProducto").val(fila[0].innerHTML); 
        /*
        var claveProducto = fila[0].innerHTML;            
        var nombreProducto = fila[0].innerHTML;
        var clasificacion = fila[1].innerHTML;
        var precio = fila.innerHTML;
        var existencia = fila[3].innerHTML;
        var proveedor = fila[4].innerHTML; 
        var descripcion = fila[5].innerHTML;                      
        $("#inClaveProducto").val(claveProducto); 
        $("#inClaveProducto").prop("disabled", true); 
        $("#inNomProducto").val(nombreProducto);
        $("#inClasificacion").val(clasificacion); 
        $("#inPrecio").val(precio.replace("$","")); 
        $("#inCantExistencia").val(existencia);             
        $("#inDescripcion").val(descripcion); */      
    });

//Limpiar las entradas para que no quede reciduo
function limpiar(){
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