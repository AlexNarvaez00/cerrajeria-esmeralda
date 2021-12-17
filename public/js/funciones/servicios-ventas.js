$("#flexSwitchCheckDefault").on("click", function() {
    var condicion = $("#flexSwitchCheckDefault").is(":checked");
    //Si el switch habilita
    limpiar();
    if(condicion){        
        isClienteRegistrado();
    }else{
        isNotClienteRegistrado();
    }

});
//Si el cliente ya esta registrado
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
    $( "#inputIdCliente" ).val("");
    $( "#inputNombreCliente" ).val("");
    $( "#inputApellidoPCliente" ).val("");
    $( "#inputApellidoMCliente" ).val("");
    $( "#inputNumTelefono" ).val("");
}