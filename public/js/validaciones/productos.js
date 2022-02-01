//Esto es un objeto, bueno, una manera de hacerlos
const expresionesRegulares = {
    claveProducto: /^[a-zA-Z|\-|\d]{1,10}$/,
    caracteres: /^[a-zA-Z|-|\s]{1,20}$/,
    cantidades: /\d/,
    NumTelefono: /^[0-9]{10}$/,
    nombreProveedor: /^[a-zA-Z|-|\s]{1,50}$/,
    Correo:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
};
validator([
    //[document.getElementById("inClaveProducto"),expresionesRegulares.claveProducto],
    [document.getElementById("inClasificacion"),expresionesRegulares.caracteres],
    [document.getElementById("inPrecio"), expresionesRegulares.cantidades],
    [document.getElementById("inNomProducto"), expresionesRegulares.caracteres],
    [document.getElementById("inPreciocompra"), expresionesRegulares.cantidades], 
    [document.getElementById("inDescripcion"), expresionesRegulares.caracteres],
    [document.getElementById("inCantExistencia"), expresionesRegulares.cantidades],
    [document.getElementById("txtNumeroProveedor"), expresionesRegulares.NumTelefono],
    [document.getElementById("txtNombreProveedor"), expresionesRegulares.nombreProveedor],
    [document.getElementById("txtApellidoPProveedor"), expresionesRegulares.nombreProveedor],
    [document.getElementById("txtApellidoMProveedor"), expresionesRegulares.nombreProveedor],
    //[document.getElementById("txtCorreoProveedor"), expresionesRegulares.Correo],
    [document.getElementById("numeroProveedor"), expresionesRegulares.cantidades],
    [document.getElementById("calleProveedor"), expresionesRegulares.caracteres],
    [document.getElementById("inStock"), expresionesRegulares.cantidades]
]);
//Opcion para el boton editar
$(".btnEditar").on("click", function () {
    let fila = $(this).closest("tr").find(".dato");
    var claveproducto = fila[0].innerHTML;
    var claveProveedor = fila[6].innerHTML;

    $("#btnRegistrarProducto").hide();
    $("#btnGuardarCambios").show();
    $("#inClaveProducto").prop("disabled", true);
    $("#inClaveProducto").val(fila[0].innerHTML);
    $("#inNomProducto").val(fila[1].innerHTML);
    $("#inClasificacion").val(fila[2].innerHTML);
    $("#inPrecio").val(fila[3].innerHTML.replace("$", ""));
    $("#inPreciocompra").val(fila[4].innerHTML.replace("$", ""));
    $("#inCantExistencia").val(fila[5].innerHTML);
    $("#inStock").val(fila[7].innerHTML);

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
    var claveProveedor = fila[6].innerHTML;    
    $("#detalleClave").val(claveproducto);
    $("#detalleNombreProducto").val(fila[1].innerHTML);
    $("#detalleClasificacion").val(fila[2].innerHTML);
    $("#detallePrecio").val(fila[3].innerHTML);
    $("#detalleExistencia").val(fila[5].innerHTML);
    $("#detallePrecioCompra").val(fila[4].innerHTML);
    $("#detallestock").val(fila[7].innerHTML);
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
    $("#inPrecio").val("1.00");
    $("#inCantExistencia").val("0");
    $("#inDescripcion").val("");
}
//Agrega a un nuevo proveedor
$("#formularioProveedor").on("submit", function (e) {
    e.preventDefault();
    var datosFormulario = $(this).serializeArray();    
    minAjax({
        url: "/agrega/proveedor",
        type: "POST",
        data: {
            _token: document.querySelector('input[name="_token"]').value,
            proveedor:datosFormulario.map(e=>`{"name":"${e.name}","value":"${e.value}"}`)
        },     
        //= ="modal" data-bs-dismiss="modal"   
        success: function(data){   
            data = JSON.parse(data); 
            alert(data);     
            $("#proveedores").append(
                $("<option>", {
                    value: data.idproveedor,
                    text: data.idproveedor + " "+data.nombre,
                })
            );            
            $("#proveedores option[value='"+data.idproveedor+"']").attr("selected", true);
            $("#agregarProveedor").modal('hide');
            $("#registroProductoModal").modal("show");
        }
       });
});
//Verifica si existe el id
$('#inClaveProducto').on('keyup', function() {     
    minAjax({
        url: "/producto/buscar",
        type: "POST",
        data: {
            _token: document.querySelector('input[name="_token"]').value,
            clave_producto: $('#inClaveProducto').val()
        },        
        success: function(data){  
            if(data == "true"){  
                $("#labelCampoClave").text("El producto ya se encuentra registrado"); 
                $('#inClaveProducto').removeClass("is-valid");
                $('#inClaveProducto').addClass("is-invalid");
            }else{
                $('#inClaveProducto').removeClass("is-invalid");
                $('#inClaveProducto').addClass("is-valid");
                $("#labelCampoClave").text("");
                
            }                      
        }
       });   
});

$('#txtCorreoProveedor').on('keyup', function() {     
    minAjax({
        url: "/producto/buscarcorreo",
        type: "POST",
        data: {
            _token: document.querySelector('input[name="_token"]').value,
            correo: $('#txtCorreoProveedor').val()
        },        
        success: function(data){  
            $('#txtCorreoProveedor').removeClass("is-valid");
            $('#txtCorreoProveedor').removeClass("is-invalid");
            if(data == "true"){  
                $("#labelCorreoProveedor").text("El correo ya se encuentra registrado"); 
                $('#txtCorreoProveedor').removeClass("is-valid");
                $('#txtCorreoProveedor').addClass("is-invalid");
            }else{
                $('#txtCorreoProveedor').removeClass("is-invalid");
                $('#txtCorreoProveedor').addClass("is-valid");
                $("#labelCorreoProveedor").text("");
                
            }                      
        }
       });   
});



$('#btnGuardar').on('click',function(e){
    e.preventDefault();
    $( "#inClaveProducto" ).prop( "disabled", false);
    let form = $("#registroProductoModal").find("form");
    var datosFormulario = form.serializeArray();  
    
     
    minAjax({
        url: "/producto/cambiar",
        type: "POST",
        data: {
            _token: document.querySelector('input[name="_token"]').value,
            producto:datosFormulario.map(e=>`{"name":"${e.name}","value":"${e.value}"}`)
        },        
        success: function(data){  
            $('#liveToast').toast('show');
            window.location.reload();            
        }
       });
});

$("#inPrecio").on("blur",function(event){
    var precio = $("#inPrecio").val();
    compararPrecios();
    if(precio == ""){
        $("#inPrecio").val();
    }else{

    }
});



function compararPrecios(){
    var precio_compra = parseFloat($("#inPreciocompra").val());
    var precio_venta = parseFloat($("#inPrecio").val());
    if(precio_venta < precio_compra){        
        alert("El precio de la venta no puede ser mayor al precio de la compra");
        $("#inPreciocompra").val("0.00");
        $("#inPrecio").val("1.00");
    }
}

$("#inClaveProducto").on("blur",function(event){
    var temp = $("#inClaveProducto").val();
    if(temp == ""){
        $('#inClaveProducto').removeClass("is-valid");
        $('#inClaveProducto').addClass("is-invalid");
        $("#labelCampoClave").text("El campo no debe estar vacio");
    }
});

$("#inNomProducto").on("blur",function(event){
    if($("#inNomProducto").val() == ""){
        $('#inNomProducto').addClass("is-invalid");
        $("#labelNombreProducto").text("El campo no debe estar vacio");
    }
});
$("#inNomProducto").on("focus",function(event){
        $("#labelNombreProducto").text("");    
});

$("#inClasificacion").on("blur",function(event){
    if($("#inClasificacion").val() == ""){
        $('#inClasificacion').addClass("is-invalid");
        $("#labelClasificacion").text("El campo no debe estar vacio");
    }
});
$("#inClasificacion").on("focus",function(event){
        $("#labelClasificacion").text("");    
});

$("#inCantExistencia").on("blur",function(event){
    var temp = $("#inCantExistencia").val();
    if(temp == ""){
        $('#inCantExistencia').addClass("is-invalid");
        $("#labelCantExistencia").text("El campo no debe estar vacio");
    }
});
$("#inCantExistencia").on("focus",function(event){
        $("#labelCantExistencia").text("");    
});
$("#inPreciocompra").on("blur",function(event){
    var temp = $("#inPreciocompra").val();
    if(temp == ""){
        $('#inPreciocompra').addClass("is-invalid");
        $("#labelPreciocompra").text("El campo no debe estar vacio");
    }
});
$("#inPreciocompra").on("focus",function(event){
        $("#labelPreciocompra").text("");    
});
$("#inPrecio").on("blur",function(event){
    var temp = $("#inPrecio").val();
    if(temp == ""){
        $('#inPrecio').addClass("is-invalid");
        $("#labelPrecio").text("El campo no debe estar vacio");
    }
});
$("#inPrecio").on("focus",function(event){
        $("#labelPrecio").text("");    
});
$("#inDescripcion").on("blur",function(event){
    var temp = $("#inDescripcion").val();
    if(temp == ""){
        $('#inDescripcion').addClass("is-invalid");
        $("#labelDescripcion").text("El campo no debe estar vacio");
    }
});
$("#inDescripcion").on("focus",function(event){
    $('#inDescripcion').removeClass("is-invalid");
        $("#labelDescripcion").text("");    
});
//proveedor
$("#txtNombreProveedor").on("blur",function(event){
    var temp = $("#txtNombreProveedor").val();
    if(temp == ""){
        $('#txtNombreProveedor').addClass("is-invalid");
        $("#labelNombreProveedor").text("El campo no debe estar vacio");
    }
});
$("#txtNombreProveedor").on("focus",function(event){
        $("#labelNombreProveedor").text("");    
});
//--------------------
$("#txtApellidoPProveedor").on("blur",function(event){
    var temp = $("#txtApellidoPProveedor").val();
    if(temp == ""){
        $('#txtApellidoPProveedor').addClass("is-invalid");
        $("#labelApellidoPProveedor").text("El campo no debe estar vacio");
    }
});
$("#txtApellidoPProveedor").on("focus",function(event){
        $("#labelApellidoPProveedor").text("");    
});
//--------------------
$("#txtApellidoMProveedor").on("blur",function(event){
    var temp = $("#txtApellidoMProveedor").val();
    if(temp == ""){
        $('#txtApellidoMProveedor').addClass("is-invalid");
        $("#labelApellidoMProveedor").text("El campo no debe estar vacio");
    }
});
$("#txtApellidoMProveedor").on("focus",function(event){
        $("#labelApellidoMProveedor").text("");    
});
//---------------
$("#txtCorreoProveedor").on("blur",function(event){
    var temp = $("#txtCorreoProveedor").val();
    if(temp == ""){
        $('#txtCorreoProveedor').addClass("is-invalid");
        $("#labelCorreoProveedor").text("El campo no debe estar vacio");
    }
});
$("#txtCorreoProveedor").on("focus",function(event){
        $("#labelCorreoProveedor").text("");    
});
//--------------------
$("#txtNumeroProveedor").on("blur",function(event){
    var temp = $("#txtNumeroProveedor").val();
    if(temp == ""){
        $('#txtNumeroProveedor').addClass("is-invalid");
        $("#labelNumeroProveedor").text("El campo no debe estar vacio");
    }
});
$("#txtNumeroProveedor").on("focus",function(event){
        $("#labelNumeroProveedor").text("");    
});
//--------------------
$("#numeroProveedor").on("blur",function(event){
    var temp = $("#numeroProveedor").val();
    if(temp == ""){
        $('#numeroProveedor').addClass("is-invalid");
        $("#labelnnumeroProveedor").text("El campo no debe estar vacio");
    }
});
$("#numeroProveedor").on("focus",function(event){
        $("#labelnnumeroProveedor").text("");    
});
//--------------------
$("#calleProveedor").on("blur",function(event){
    var temp = $("#calleProveedor").val();
    if(temp == ""){
        $('#calleProveedor').addClass("is-invalid");
        $("#labelcalleProveedor").text("El campo no debe estar vacio");
    }
});
$("#calleProveedor").on("focus",function(event){
        $("#labelcalleProveedor").text("");    
});
//--------------------

