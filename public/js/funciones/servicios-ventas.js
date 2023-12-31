const expresionesRegulares = {
    claveProducto: /^[a-zA-Z|\-|\d]{1,10}$/,
    caracteres: /^[a-zA-Z|-|\s]{1,20}$/,
    cantidades: /\d/,
    NumTelefono: /^[0-9]{10}$/,
    nombreProveedor: /^[a-zA-Z|-|\s]{1,50}$/,
    Correo:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    NumExt:/^[0-9]{3,4}[A-Z-]{0,3}$/
};

validator([
    [document.getElementById("inputNombreCliente"),expresionesRegulares.caracteres],
    [document.getElementById("inputApellidoPCliente"),expresionesRegulares.caracteres],
    [document.getElementById("inputApellidoMCliente"),expresionesRegulares.caracteres],
    [document.getElementById("inputNumTelefono"),expresionesRegulares.NumTelefono],
    [document.getElementById("inputCalle"),expresionesRegulares.caracteres],
    [document.getElementById("inputNumExt"),expresionesRegulares.NumExt],
    [document.getElementById("inputNumInt"),expresionesRegulares.NumExt]
]);



//establece si el cliente ya esta registrado o se va a registrar
$("#flexSwitchCheckDefault").on("click", function() {
    var condicion = $("#flexSwitchCheckDefault").is(":checked");    
    limpiar();
    if(condicion){        
        isClienteRegistrado();
    }else{
        isNotClienteRegistrado();
    }

});
//Si el cliente ya esta registrado realiza esta opción
function isClienteRegistrado(){      
    $( "#btnBuscarCliente " ).prop( "disabled", false); 
    $( "#inputIdCliente" ).prop( "disabled", false);
    $( "#inputNombreCliente" ).prop( "disabled", true );
    $( "#inputApellidoPCliente" ).prop( "disabled", true );
    $( "#inputApellidoMCliente" ).prop( "disabled", true );
    $( "#inputNumTelefono" ).prop( "disabled", true );
}
//Si el cliente no se ha registrado realiza esta opción
function isNotClienteRegistrado(){ 
    $( "#btnBuscarCliente " ).prop( "disabled", true);    
    $( "#inputIdCliente" ).prop( "disabled", true);
    $( "#inputNombreCliente" ).prop( "disabled", false);
    $( "#inputApellidoPCliente" ).prop( "disabled", false);
    $( "#inputApellidoMCliente" ).prop( "disabled", false);
    $( "#inputNumTelefono" ).prop( "disabled", false);
}
//limpia las entradas para que no quede residuo
function limpiar(){
    $( "#inputIdCliente").val("");
    $( "#inputNombreCliente" ).val("");
    $( "#inputApellidoPCliente" ).val("");
    $( "#inputApellidoMCliente" ).val("");
    $( "#inputNumTelefono" ).val("");
}
//Busca a un cliente ya registrado
$("#btnBuscarCliente").on("click", function() {    
    idetificadorCliente = $("#inputIdCliente").val();   
    if(idetificadorCliente != ""){
       minAjax({
        url:"/cliente/todo", 
        type:"POST",
        data:{
            _token: document.querySelector('input[name="_token"]').value,
            id:idetificadorCliente
        },        
        success: function(data){
            data = JSON.parse(data);                            
            if(data.nombre != null){
                $('#inputNombreCliente').val(data.nombre);
                $('#inputApellidoPCliente').val(data.apellidoPaterno);
                $('#inputApellidoMCliente').val(data.apellidoMaterno);
                $('#inputNumTelefono').val(data.telefono);  
            }else{
                alert("El cliente no se encontró");
                $("#inputIdCliente").val("");
            }  
        }
       });           
    }else{
        alert("Se requiere como entrada un idCliente");
    }
});
//Agrega los muncicipios del estado seleccionado
$("#inputEstado").on("change", function() { 
    let valor = $("#inputEstado").val();    
    if(valor != '0'){
       minAjax({
        url:"/estado/servicio", 
        type:"POST",
        data:{
            _token: document.querySelector('input[name="_token"]').value,
            id:valor
        },        
        success: function(data){
            data = JSON.parse(data);            
            let selectorMunicipio = document.getElementById('idMunicipio');            
            let textoSelectorOP1 = document.createElement('option');
            textoSelectorOP1.innerHTML = "Selecciona un municipio";
            textoSelectorOP1.value = 0;
            let opcionesSeleccion = [textoSelectorOP1];
            for (let index = 0; index < data.length; index++) {
                let opcion =  document.createElement('option');
                opcion.innerHTML = data[index].nombre;                       
                opcion.value = data[index].idmunicipio;
                opcionesSeleccion.push(opcion);                            
            }
            $("#idMunicipio").empty();
            for (let idx = 0; idx < opcionesSeleccion.length; idx++) {                    
                selectorMunicipio.appendChild(opcionesSeleccion[idx]);                    
            }
        }
       });
    }
});
//Agrega los asentamientos del municipio seleccionado
$("#idMunicipio").on("change", function() {    
    let valor = $("#idMunicipio").val();            
    if(valor != '0'){
        minAjax({
            url:"/municipio/servicio", 
            type:"POST",
        data:{
            _token: document.querySelector('input[name="_token"]').value,
            idmunicipio:valor
        },                    
        success: function(data){
            data = JSON.parse(data);            
            let selectorColonia = document.getElementById('idColonia');                    
            let textoSelectorOP1 = document.createElement('option');
            textoSelectorOP1.innerHTML = "-- Selecciona una colonia --";
            textoSelectorOP1.value = 0;
            let opcionesSeleccion = [textoSelectorOP1];
            for (let index = 0; index < data.length; index++) {
                let opcion =  document.createElement('option');
                opcion.innerHTML = data[index].nombre;                       
                opcion.value = data[index].idcolonia;
                opcionesSeleccion.push(opcion);                      
            }
            selectorColonia.innerHTML = '';
            for (let idx = 0; idx < opcionesSeleccion.length; idx++) {
                selectorColonia.appendChild(opcionesSeleccion[idx]);                    
            }
        }
        });              
    }
});

$(".btnDetalleServicio").on("click", function(event){    
    let fila = $(this).closest("tr").find(".data");
    var idServicio = fila[0].innerHTML;
    minAjax({
        url:"/servicio/show", 
        type:"POST",
    data:{
        _token: document.querySelector('input[name="_token"]').value,
        id:idServicio
    },                    
    success: function(data){
        data = JSON.parse(data);            
        $("#inDetalleIDservicio").val(data.idservicio);
        $("#inSubtotal").val(data.monto);
        $("#inareaDescripcionDetalle").val(data.descripcion);
        $("#letreroDetalleFecha").text("Fecha y hora en que se solicito el servicio: " + data.fechayhora);
    }
    }); 

});

$(".btnDetalleCliente").on("click", function(event){
    let fila = $(this).closest("tr").find(".data");
    var idCliente = fila[5].innerHTML;
    var idDireccion = fila[2].innerHTML;
    minAjax({
        url:"/servicio/infoCliente", 
        type:"POST",
    data:{
        _token: document.querySelector('input[name="_token"]').value,
        id:idCliente,
        idDireccion:idDireccion
    },                    
    success: function(data){
        data = JSON.parse(data); 
        $("#infoIdCliente").val(data.data.cliente.idcliente);
        $("#infoNombre").val(data.data.cliente.nombre);
        $("#infoAP").val(data.data.cliente.apellidoPaterno);
        $("#infoAM").val(data.data.cliente.apellidoMaterno);
        $("#infoAM").val(data.data.cliente.apellidoMaterno);
        $("#infoTel").val(data.data.cliente.telefono);
        $("#infoCalle") .val(data.data.direccion.calle); 
        $("#infoNumEx") .val(data.data.direccion.numero); 
        $("#infoColonia") .val(data.data.colonia.nombre);  
        $("#infoMunicipio") .val(data.data.municipio.nombre);  
        $("#infoEstado") .val(data.data.estado.nombre);
    }
    });
});

$("#btnRealizarVenta").on("click",function(event){
    var total = $("#inSubtotal").val();
   $("#inTotalPagar").val(total);
});

$("#inMontoRecibido").on("keyup",function(event){
    var montoRecibido = parseFloat($("#inMontoRecibido").val());
    var totalPagar = parseFloat($("#inTotalPagar").val());
    var cambio = montoRecibido - totalPagar;
    if(montoRecibido > 0){
        $("#letreroCambio").text("Cambio $"+cambio);
        if(montoRecibido >= totalPagar){
            $("#btnTerminarV").prop("disabled",false);
        }else{
            $("#btnTerminarV").prop("disabled",true);
        }
    }else{
        $("#letreroCambio").text("Cambio $0.00");
        $("#btnTerminarV").enable("disabled",true);
    }
});
//----
$("#inputNombreCliente").on("blur",function(event){
    var temp = $("#inputNombreCliente").val();
    if(temp == ""){
        $('#inputNombreCliente').addClass("is-invalid");
        $("#labelNombreCliente").text("El campo no debe estar vacio");
    }
});
$("#inputNombreCliente").on("focus",function(event){
        $("#labelNombreCliente").text("");    
});
//--------------------
$("#inputApellidoPCliente").on("blur",function(event){
    var temp = $("#inputApellidoPCliente").val();
    if(temp == ""){
        $('#inputApellidoPCliente').addClass("is-invalid");
        $("#labelApellidoPCliente").text("El campo no debe estar vacio");
    }
});
$("#inputApellidoPCliente").on("focus",function(event){
        $("#labelApellidoPCliente").text("");    
});
//--------------------
$("#inputApellidoMCliente").on("blur",function(event){
    var temp = $("#inputApellidoMCliente").val();
    if(temp == ""){
        $('#inputApellidoMCliente').addClass("is-invalid");
        $("#labelApellidoMCliente").text("El campo no debe estar vacio");
    }
});
$("#inputApellidoMCliente").on("focus",function(event){
        $("#labelApellidoMCliente").text("");    
});
//--------------------
$("#inputNumTelefono").on("blur",function(event){
    var temp = $("#inputNumTelefono").val();
    if(temp == ""){
        $('#inputNumTelefono').addClass("is-invalid");
        $("#labelNumTelefono").text("El campo no debe estar vacio");
    }
});
$("#inputNumTelefono").on("focus",function(event){
        $("#labelNumTelefono").text("");    
});
//--------------------
       
        


       

        
