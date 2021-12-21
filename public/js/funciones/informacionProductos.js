
let arregloBotonesMostrar = document.getElementsByClassName('btn-information-sales');
const modal = document.getElementById('InformacionModalProductos');


const cargarInformacion = (event)=>{
    let data = null;
    
    if(event.target.nodeName == 'SPAN'){
        data = event.target.parentElement.dataset;
    }else{
        data = event.target.dataset;
    }
    
    let modalBody = modal.querySelector('.container-information');
    
    //Ajax
    minAjax({
        url:data.urlQuery,//request URL
        type:"GET",//Request type GET/POST
        //Send Data in form of GET/POST
        data:{
        },
        //CALLBACK FUNCTION with RESPONSE as argument
        success: function(data){
          data = JSON.parse(data);
            for (let index = 0; index < data.length; index++) {
                const informacionProdcutos = data[index];
                modalBody.innerHTML="";
                //console.log(informacionProdcutos);
                let divNuevo = document.createElement('p');
                divNuevo.innerText = 'nombre_producto:'+informacionProdcutos.nombre_producto+
                                    '\ncantidad: '+informacionProdcutos.cantidad+
                                    '\ncantidad_existencia: '+informacionProdcutos.cantidad_existencia+
                                    '\nclasificacion: '+informacionProdcutos.clasificacion;
                modalBody.appendChild(divNuevo);                                    
            }
        }
      });
};




for (let index = 0; index < arregloBotonesMostrar.length; index++) {
    const boton = arregloBotonesMostrar[index];
    boton.addEventListener('click',cargarInformacion);
}