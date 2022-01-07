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

//Agrega al carrito
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
                                +'<td class="inCantidad"></td>'
                                +"<td>"+data.cantidad_existencia+"</td>"
                                +"<td>"+'$'+data.precio_producto+"</td>"
                                +"<td>"+data.cantidad_stock+"</td>"                            
                                +'<td class="btnQuitar"></td>'
                            +"</tr>";
                    $('#tabla tr:last').after(fila);

                    $("#tabla tr:last").find(".btnQuitar").append(
                    '<a class = "btnQuitarCarro">'                                                     
                    +'<button type="button" class="btn">'
                        + '<span>&#10060;</span>'
                    +'</button>'  
                    +'</a>');     
                
                $("#tabla tr:last").find(".inCantidad").append(               
                    '<input type="number" class="inCantidad" value="1" size=20 style="width:50px" min=1 max='+data.cantidad_existencia+'>'                
                    );  
                    carrito.push(clave_producto); 
                    $("#conProductos").text(carrito.length);                
                }
                $("#tabla tr:last").find(".inCantidad").on("keydown", function(){
                    var cantTemp = $("#tabla tr:last").find(".inCantidad").text(); 
                    alert(data.cantidad_existencia);                   
                    if(cantTemp > data.cantidad_existencia){
                        
                        $("#tabla tr:last").find(".inCantidad").focus();
                        $("#tabla tr:last").find(".inCantidad").unbind("keydown");
                    }
                });
                }
            
        });   
    }else{
        alert("Este producto ya esta en la cesta");
    }
});

function validarCantidad(cantidad_existencia){

}

/*
let observacion = $("#areaObservaciones").val(); 
                if(observacion == ""){
                    observacion = "Sin observaciones";
                }
                let cantidadProducto = $("#inCantExistencia").val();
                if(cantidadProducto <= data.cantidad_existencia && data.cantidad_existencia != 0){
                    fila = '<tr><td> ' + data.clave_producto+ '</td><td>'
                        +data.nombre_producto+'</td><td>'+cantidadProducto+'</td><td>'
                        +observacion+ '</td> <td>'+'$'+data.precio_producto+'</td></tr>';                
                    $('#tabla tr:last').after(fila);
                    cont ++;
                    $("#conProductos").text(cont);
                    obtenerTotal(cantidadProducto * data.precio_producto);
                    
                }else{
                    alert("Agrega mas productos para poder venderlos");
                }  
* */

//elimina todo el carrito
$("#btnEliminarCarrito").on("click", function() {    
    $('#tabla tr:not(:first)').remove();
    total = 0;
    $("#letreroTotal").text("Total a pagar: $" + total);
    cont = 0;
    $("#conProductos").text(cont);  

});

//Obteiene el total a pagar
function obtenerTotal(totalProducto){    
    total +=  totalProducto;
    $("#letreroTotal").text("Total a pagar: $" + total);
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
