var total = 0; //Obtiene el total a pagar
var cont = 0; //Obtiene la cantidad de productos que estan en el carrito
var cantidadRecibida = 0;
var cambio = 0;
let carrito = new Array();//Obtiene los productos que estan en el carrito

$("#btnCarrito").on("click", function() {
    if(carrito.length == 0){
        $("#btnRealizarVenta").prop('disabled', true); 
    }else{
        $("#btnRealizarVenta").prop('disabled', false); 
    }
});

//Abre un modal con la información de un producto antes de agregar al carrito
$(".btnAgregarAlCarro").on("click", function() {    
    
    let fila = $(this).closest("tr").find(".dato"); //Obtiene la fila en donde se le da clic
    var cantidadExistencia = fila[4].innerHTML;          
    if(cantidadExistencia > 0){
        $("#liveToast").toast("hide");
        $("#agregarcarritoModal").modal("show");
        $("#letreroIdProducto").text(fila[0].innerHTML);        
        $("#letreroConfirmacion").text("¿Deseas agregar a "+ fila[1].innerHTML+" al carrito?");
    }else{
        $("#liveToast").toast("show");
    }        
});

//Agrega al carrito un producto
$("#btnConfirmacionCarro").on("click", function() {     
    var clave_producto = $("#letreroIdProducto").text();       
    if(!verificar(clave_producto)){  
        $("#btnRealizarVenta").prop('disabled', true);      
        minAjax({
            url:"/producto/venta", 
            type:"POST",
            data:{
                _token: document.querySelector('input[name="_token"]').value,
                clave_producto:clave_producto            
            },        
            success: function(data){
                data = JSON.parse(data);                            
                if(data != null){                
                    fila = "<tr>"
                                +"<th>"+data.clave_producto+ "</th>"
                                +'<td class="nombreProductosColumnas">'+data.nombre_producto+"</td>"
                                +'<td class="inCantidadProductosCompras"></td>'
                                +"<td>"+data.cantidad_existencia+"</td>"
                                +"<td>"+data.cantidad_stock+"</td>"
                                +'<td class="preciosProductosColumnas">'+'$'+data.precio_producto+"</td>"                            
                                +'<td class="btnQuitar"></td>'
                            +"</tr>";
                    $('#tabla tr:last').after(fila);

                    $("#tabla tr:last").find(".btnQuitar").append(
                    '<a class = "btnQuitarCarro">'                                                     
                    +'<button type="button" class="btn" id="btn'+data.clave_producto+'">'
                        + '<span>&#10060;</span>'
                    +'</button>'  
                    +'</a>');
                
                $("#tabla tr:last").find(".inCantidadProductosCompras").append(               
                    '<input type="number" class="inCantidad" value="1" size=20 style="width:50px" min=1 max='+data.cantidad_existencia+' id="'+data.clave_producto+'">'                
                    );                   
                    carrito.push(clave_producto);
                    $("#conProductos").text(carrito.length);   
                    validarCantidad(data);
                    eliminarFila(data);
                    $("#btnRealizarVenta").prop('disabled', false); 
                    obtenerTotal();

                }                
            }           
        });   
    }else{
        alert("Este producto ya esta en la cesta");
    }
});



//Elimna una fila del carrito
function eliminarFila(data){
    $("#btn"+data.clave_producto).on('click', function (event) {
        $(this).closest('tr').remove();
        const index = carrito.indexOf(data.clave_producto);
        if (index > -1) {
            carrito.splice(index, 1);
          }
          $("#conProductos").text(carrito.length); 
          obtenerTotal();

    });


}
//valida que las entradas de la cantidad no sean negativas ni se queden vacias al perder el foco
function validarCantidad(data){    
    $("#"+data.clave_producto).on("keyup", function(event){
        var cantTemp = $("#"+data.clave_producto).val();                      
        if(cantTemp > data.cantidad_existencia){   
            $("#"+data.clave_producto).val(data.cantidad_existencia); 
        }else{
            if(cantTemp < data.cantidad_existencia){
                $("#"+data.clave_producto).val(cantTemp.replace("-",""));
            }
        }
        $("#"+data.clave_producto).on("blur",function(){
            if($("#"+data.clave_producto).val() == ""){
                $("#"+data.clave_producto).val("1");
            }
        });
        obtenerTotal();
    });
}

//elimina todo el carrito
$("#btnEliminarCarrito").on("click", function() {    
    $('#tabla tr:not(:first)').remove();   
    cont = 0;
    $("#conProductos").text(cont);  
    $("#btnRealizarVenta").prop('disabled', true);
    obtenerTotal();

});

//Obteiene el total a pagar
function obtenerTotal(){ 
    total = 0;
    let valores = $(".inCantidad"); 
    let preciosIndividuales = $(".preciosProductosColumnas");    
    if(carrito.length > 0){
        $("#btnRealizarVenta").prop('disabled', false);
        for(var i = 0; i < carrito.length; i++){
            var subtotal = valores[i].value * preciosIndividuales[i].innerHTML.replace('$','');
            total +=  subtotal;
        }
        $("#letreroTotal").text("Total a pagar: $" + total);
    }else{
        $("#letreroTotal").text("Total a pagar: $0.00");
        $("#btnRealizarVenta").prop('disabled', true);
    }  
    
      
    
    
}


//bloquea las entradas si la cantidad en el inventario es 0
function bloquear(){
    $("#inCantExistencia").val("0");
    $("#letreroNombre").text("Agregué productos al inventario");          
    $( "#botonModalConfirmacion" ).prop( "disabled", true );
    $( "#areaObservaciones" ).prop( "disabled", true );
    $( "#inCantExistencia" ).prop( "disabled", true );
}

//Limpia las entradas para que no quede residuo
function limpiar(){
    $("#letreroNombre").text(""); 
    $("#letreroPrecio").text(""); 
    $("#inCantExistencia").val("1");
    $("#areaObservaciones" ).val("");
    $("#botonModalConfirmacion").prop("disabled", false);
    $("#areaObservaciones" ).prop("disabled", false);
    $("#inCantExistencia" ).prop( "disabled", false);  
}

//verificar si ya se agrego un producto al carrito
function verificar(claveAgregada){   
    for(var i = 0; i < carrito.length; i++){        
        if(carrito[i]==claveAgregada){
            return true;
        }        
    }    
    return false;
}

$('#btnRealizarVenta').on("click", function() {
    $('#tabla2 tr:not(:first)').remove();  
    let valores = $(".inCantidad"); 
    let preciosIndividuales = $(".preciosProductosColumnas");
    let nombreProductos = $(".nombreProductosColumnas");
    for(var i = 0; i < carrito.length; i ++){
        var nombreTemp =  nombreProductos[i].innerHTML;
        var precioIndividualTemp = preciosIndividuales[i].innerHTML.replace('$','');
        var cantidadTemp = valores[i].value;

        fila = "<tr>"
            +"<th>"+carrito[i]+ "</th>"
            +'<td class="nombreRealizarVenta">'+nombreTemp+"</td>"            
            +'<td class="cantidadRealizarVenta">'+cantidadTemp+"</td>"
            +'<td class="precioIndividualRealizaVenta">'+"$"+precioIndividualTemp+"</td>"                                     
            +"<td>"+"$"+cantidadTemp*precioIndividualTemp+"</td>"
            +"</tr>";
            $('#tabla2 tr:last').after(fila);

    }
    $("#letreroTotalConfirmacion").text("Total a pagar $" + total);            

 });


$("#cantidadRecibida").on("keyup", function(event){
    var temp = $("#cantidadRecibida").val();
    if(temp < 0.00 || temp.includes("-")){
        $("#cantidadRecibida").val("0.00");
        $("#btnFinalizarCompra").prop("disabled",true);
        cambio = 0;
    }else{        
        cantidadRecibida = temp;
        cambio = cantidadRecibida -total; 
        if(cambio < 0){
            $("#btnFinalizarCompra").prop("disabled",true);
        }else{
            $("#btnFinalizarCompra").prop("disabled",false);    
        }           
    }    
    $("#letreroCambio").text("Cambio: $" + cambio);
});

$("#btnFinalizarCompra").on("click",function(event){  
    $("#letreroCantidadRecibida").text("Cantidad Recibida: $" + cantidadRecibida);
    $("#letreroCantidadCambio").text("Cambio: $" + cambio );
    $("#letreroTotalPagar").text("Total a pagar: $" + total);

    let nombres = $(".nombreRealizarVenta");
    let cantidadProducto = $(".cantidadRealizarVenta");
    let precioUnitario = $(".precioIndividualRealizaVenta");
    
    for(var i = 0; i < carrito.length; i++){
        alert(nombres[i].innerHTML +" "+cantidadProducto[i].innerHTML );
        componente = '<div class="row">'
                        +'<div class="col-md-1 col-sm-1  justify-content-center">'
                            +cantidadProducto[i].innerHTML
                        +'</div>'
                        +'<div class="col-md-5 col-sm-5 justify-content-center">'
                            +carrito[i]+' '+nombres[i].innerHTML
                        +'</div>'
                        +'<div class="col-md-3 col-sm-3  justify-content-center">'
                            +precioUnitario[i].innerHTML
                        +'</div>'
                        +'<div class="col-md-3 col-sm-3  justify-content-start">'
                            +"$"+(cantidadProducto[i].innerHTML * precioUnitario[i].innerHTML.replace("$",""))
                        +'</div>'
                    +'</div>'
        $("#descripcionProductosDetalleCompra").append(componente);
    }

});


