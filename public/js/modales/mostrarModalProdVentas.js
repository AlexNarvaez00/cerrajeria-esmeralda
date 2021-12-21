var total = 0; //Obtiene el total a pagar
var cont = 0; //Obtiene la cantidad de productos que estan en el carrito
let carrito = [];//Obtiene los productos que estan en el carrito

//Abre un modal con la información de un producto antes de agregar al carrito
$(".btnAgregarAlCarro").on("click", function() {    
    let fila = $(this).closest("tr").find(".dato"); //Obtiene la fila en donde se le da clic
    var cantidadExistencia = fila[3].innerHTML;
    if(cantidadExistencia == 0){
        bloquear();
    }else{
        limpiar();
    }
    $("#letreroID").text(fila[0].innerHTML);
    $("#letreroNombre").text(fila[1].innerHTML);
    $("#letreroPrecio").text("Precio individual: " + fila[2].innerHTML);    
});
//Agrega al carrito
$("#btnConfirmacionCarro").on("click", function() {    
    identificadorProducto= $("#letreroID").text();       
    minAjax({
        url:"/producto/venta", 
        type:"POST",
        data:{
            _token: document.querySelector('input[name="_token"]').value,
            clave_producto:identificadorProducto,
            cant:4
        },        
        success: function(data){
            data = JSON.parse(data);                            
            if(data.nombre_producto != null){
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
            }
        }
    });   
});

//elimina todo el carrito
$("#btnEliminarCarrito").on("click", function() {
    event.preventDefault();
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
    str1 = new String(claveAgregada);      
    $('#tabla tr').each(function() {
        var productoId = $(this).find("td:first").html();  
        str2 = new String(productoId);  
        alert(productoId);           
        if(!str1.toLowerCase() === str2.toLowerCase()){
           alert(claveAgregada + " " + productoId);
            return new Boolean(true);
        }  
     });
     //return new Boolean (false);

}