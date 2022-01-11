//  //Mini codigo para verificar que si existan notificaciones en la base de datos.
$.getJSON("/notificaciones/existencia/total", (resp) => {
    if (resp.cantidad != 0) {
        let btnNotificaciones = document.getElementById("btnNoificaciones");

        if (btnNotificaciones) {
            let plural =
                Number(resp.cantidad) === 1
                    ? " notificacion"
                    : " notificaciones";

            btnNotificaciones.classList.add("text-danger");
            btnNotificaciones.title = "Tienes: " + resp.cantidad + plural;
            var tooltip = new bootstrap.Tooltip(btnNotificaciones, {});

            let URL = $(location).attr("pathname");
            if (!URL.includes("notificaciones")) {
                tooltip.show();
            }
        }

        let cantidadTag = document.getElementById("cantidad");

        if (cantidadTag) {
            cantidadTag.innerHTML = resp.cantidad;
        }
    }
});



//  minAjax({
//     url: "/notificaciones/existencia/total", //request URL
//     type: "GET", //Request type GET/POST
//     //Send Data in form of GET/POST
//     data: { },
//     //CALLBACK FUNCTION with RESPONSE as argument
//     success: function(data) {
//         let number = JSON.parse(data);
//         if(number.cantidad != 0){
//             var btnNotificaciones = document.getElementById('btnNoificaciones');
//             let plural = (Number(number.cantidad) === 1)?' notificacion':' notificaciones';

//             btnNotificaciones.title = 'Tiene: '+number.cantidad+plural;
//             btnNotificaciones.classList.add('text-danger');

//             let cantidadTag = document.getElementById('cantidad');
//             if(cantidadTag){
//                 cantidadTag.innerHTML = number.cantidad;
//             }

//             var tooltip = new bootstrap.Tooltip(btnNotificaciones, {});
//             tooltip.show();
//         }
//     }

// });
