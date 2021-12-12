const formulariosAgregarCarrito = document.getElementsByClassName("form-carrito");
const eliminarCarro  = document.getElementById("btnEliminarCarrito");
var total = 0; //Obtiene el total a pagar
var cont = 0;

for (let index = 0; index < formulariosAgregarCarrito.length; index++) {
    const productoCarrito = formulariosAgregarCarrito[index];    
    //Agregamos el vento de submit a cada "formulario" de las filas
    //en los registros de la tabla
    productoCarrito.addEventListener("submit", (event) => {        
        event.preventDefault(); //Evitamos que el formulario envie cosas.                 
        let filaHTML = event.target.parentNode.parentNode;
        let registros = filaHTML.getElementsByClassName("dato");
        let cantidadProductos = registros[3].innerHTML; //Obtiene la cantidad del inventario
        limpiar();
        if(cantidadProductos == 0){           
            bloquear();          
        }else{            
            $("#letreroNombre").text(registros[0].innerHTML +" "+registros[1].innerHTML +" " +registros[4].innerHTML); 
            $("#letreroPrecio").text("Precio individual: " + registros[2].innerHTML);           
            let botonModal = document.getElementById("botonModalConfirmacion");
            botonModal.addEventListener("click", (event) => {
               
                agregarCarro(registros);             
                registros = "";
            });                    
        }             
    });
}
//elimina todo el carrito
eliminarCarro.addEventListener("click",(event)=>{
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

//Agrega una nueva fila al corrito de compras
function agregarCarro(registros){
    try {
        var fila = "";    
        let observacion = $("#areaObservaciones").val(); 
        let totalProducto = parseInt($("#inCantExistencia").val()) * parseFloat(registros[2].innerHTML.replace('$',"")); 
        obtenerTotal(totalProducto);     
        if(observacion == ""){
            observacion = "Sin observaciones";
        }    
        fila='<tr><td> ' +registros[0].innerHTML+'</td><td>'+registros[1].innerHTML+'</td><td>'+$("#inCantExistencia").val()+'</td><td>'+observacion + '</td> <td>'+'$'+totalProducto+ '</td></tr>';
        $('#tabla tr:last').after(fila);
        cont ++;
        $("#conProductos").text(cont);        
        
        registros = "";
    }catch(error){

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

//Limpia los letreros y las entradas paraq que no quede residuos en los modales
function limpiar(){
    $("#letreroNombre").text(""); 
    $("#letreroPrecio").text(""); 
    $("#inCantExistencia").val("1");
    $("#areaObservaciones" ).val("");
    $("#botonModalConfirmacion").prop("disabled", false);
    $("#areaObservaciones" ).prop("disabled", false);
    $("#inCantExistencia" ).prop( "disabled", false);  
}