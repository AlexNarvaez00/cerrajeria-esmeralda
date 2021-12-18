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
    $( "#inputIdCliente").val("");
    $( "#inputNombreCliente" ).val("");
    $( "#inputApellidoPCliente" ).val("");
    $( "#inputApellidoMCliente" ).val("");
    $( "#inputNumTelefono" ).val("");
}

//Función del boton click
$("#btnBuscarCliente").on("click", function() { 
     
    //Este input, es el input oculto de la linea 116
    //let _token = $('');
    idetificadorCliente = $("#inputIdCliente").val();
   
    if(idetificadorCliente != ""){
       minAjax({
        url:"/cliente/todo", 
        type:"POST",
        data:{
            _token: document.querySelector('input[name="_token"]').value,
            id:idetificadorCliente
        },
        //Esta funcion se ejecuta cuando el servisor nos responde con los datos que enviamos
            success: function(data){
                data = JSON.parse(data);
                console.log(data)
                $('#inputNombreCliente').val(data.nombre);
                //$('#inputNombreCliente').prop('disabled',false);

            //alert(data);

        }
       });      
    }

});
