const selectorEstado = document.getElementById('inputEstado');
const selectorMunicipio = document.getElementById('idMunicipio');
const selectorColonia = document.getElementById('idColonia');
const selectorEstadoEditar = document.getElementById('inputEstadoEditar');
const selectorMunicipioEditar = document.getElementById('idMunicipioEditar');
const selectorColoniaEditar = document.getElementById('idColoniaEditar');

function recuperarMunicipios(idSelector)
{
let valor = event.target.value;
    //Este input, es el input oculto de la linea 116
    //let _token = $('');
    
    if(valor != '0'){

       minAjax({
        url:"/estado/todo", 
        type:"POST",
        data:{
                _token: document.querySelector('input[name="_token"]').value,
                id:valor
        },
        //Esta funcion se ejecuta cuando el servisor nos responde con los datos que enviamos
        success: function(data){
            data = JSON.parse(data);
            let selectordesabilitadoM = document.getElementById(idSelector).disabled=false;
            let selectorMunicipio = document.getElementById(idSelector);
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
            selectorMunicipio.innerHTML = '';
            for (let idx = 0; idx < opcionesSeleccion.length; idx++) {
                    selectorMunicipio.appendChild(opcionesSeleccion[idx]);                    
            }
        }
       });
    }
}

function recuperarColonias(idSelector)
{
let valor = event.target.value;
    //Este input, es el input oculto de la linea 116
    //let _token = $('');
    
    if(valor != '0'){
       minAjax({
        url:"/municipio/todo", 
        type:"POST",
        data:{
                _token: document.querySelector('input[name="_token"]').value,
                idmunicipio:valor
        },
        //Esta funcion se ejecuta cuando el servisor nos responde con los datos que enviamos
            success: function(data){
            data = JSON.parse(data);
            let selectordesabilitadoC = document.getElementById(idSelector).disabled=false;
            let selectorColonia = document.getElementById(idSelector);
            let textoSelectorOP1 = document.createElement('option');
            textoSelectorOP1.innerHTML = "Selecciona una colonia";
            textoSelectorOP1.value = 0;
            let opcionesSeleccion = [textoSelectorOP1];

            for (let index = 0; index < data.length; index++) {
                let opcion =  document.createElement('option');
                opcion.innerHTML = data[index].nombre+ " CP:" + data[index].codigopostal;                       
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
}
selectorEstado.addEventListener("change",(event)=>{
    recuperarMunicipios('idMunicipio');
});

selectorMunicipio.addEventListener("change",(event)=>{
   recuperarColonias('idColonia');
});

selectorEstadoEditar.addEventListener("change",(event)=>{
    recuperarMunicipios('idMunicipioEditar');
});

selectorMunicipioEditar.addEventListener("change",(event)=>{
   recuperarColonias('idColoniaEditar');
});