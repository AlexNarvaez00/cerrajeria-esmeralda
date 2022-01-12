var total = 0; //Obtiene el total a pagar
var cont = 0; //Obtiene la cantidad de productos que estan en el carrito
let carrito = new Array();//Obtiene los productos que estan en el carrito

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
                                +"<td>"+data.nombre_producto+"</td>"
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
    obtenerTotal();

});

//Obteiene el total a pagar
function obtenerTotal(){ 
    total = 0;
    let valores = $(".inCantidad"); 
    let preciosIndividuales = $(".preciosProductosColumnas");    
    if(carrito.length > 0){
        for(var i = 0; i < carrito.length; i++){
            var subtotal = valores[i].value * preciosIndividuales[i].innerHTML.replace('$','');
            total +=  subtotal;
        }
        $("#letreroTotal").text("Total a pagar: $" + total);
    }else{
        $("#letreroTotal").text("Total a pagar: $0.00");
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
