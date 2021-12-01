@extends('rootview')

<!--Contenido del header.-->
@section('header-seccion')
<!--Esta es la prte del boton de log out -->
@component('components.header')
@slot('items')
<li class="nav-item">
    <a class="nav-link" href="../productos">Productos</a>
</li>
<li class="nav-item">
            <a class="nav-link" href="../clientes">clientes</a>
        </li>
<li class="nav-item">
    <a class="nav-link" href="../proveedores">Proveedores</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="../ventas">Ventas</a>
</li>
<li class="nav-item">
    <a class="nav-link active" href="../usuarios">Usuarios</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="../notificaciones">
        <span class="icon">&#128276;</span>
        Notificaciones
    </a>
</li>
@endslot

<!--Esta parte es para mostrar el boton de log out-->
@slot('visible',true)
@endcomponent
@endsection


@section('contenido')
<h5 class="h5 text-star mt-5 ps-3">
    <span>&#128075;</span>
    ¡Hola, {{ $nombreUsuarioVista }}!
</h5>
<h5 class="h5 text-star mt-3 mb-5 ps-3 ">
    <span>&#128101;</span>
    Usuarios
</h5>

<div class="container-fluid mb-4">
    <form class="row d-flex justify-content-end">
        <div class="col-5">
            <input type="text" class="form-control" placeholder="PlaceHolder">
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-light d-flex ps-3 pe-3">
                <span class="me-3">&#128269</span>
                Buscar
            </button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#registroUsuariosModal">
                <span class="me-3">&#10133;</span>
                Agregar
            </button>
        </div>
    </form>
</div>

<!--Seccion de la tabla-->
<div class="conteiner-fluid">
    <div class="col-12">
        <table class="table">
            <!--
            <thead>
                <tr>
                    
                        Campos de la tabla 
                        Estos lo pienso mandar desde el controlador
                    
                    @foreach ($camposVista as $campo)
                        <th scope="col">{{$campo}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($registrosVista as $registro)
                    <tr>
                        <th scope="row">{{ json_dencode($registro->idusuario) }}</th>
                    </tr>
                @endforeach 
            </tbody>
            -->
        </table>
    </div>
</div>

@component('components.modal')
    @slot('idModal','registroUsuariosModal')
    @slot('tituloModal','Registrar un nuevo usuario.')
    @slot('cuerpoModal')
        <p class="px-3">
            Informacion basica del usuario.
        </p>
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Id de Usuario</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputIDUsuario">
                    </div>
                </div>
                <!--Columnas :v-->
                <div class="col-md-6 col-sm-12">
                    <div class="input-group mb-3 ">
                        <span class="input-group-text" id="basic-addon1">Nombre de Usuario</span>
                        <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputNombreUsuario">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-md-12 col-sm-12">
                    <span class="input-group-text" id="basic-addon1">Contraseña</span>
                    <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputPasswordUsuario">
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-md-12 col-sm-12">
                    <span class="input-group-text" id="basic-addon1">Confirmar Contraseña</span>
                    <input type="password" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" id="inputPasswordUsuarioCon">
                </div>
            </div> 
        </div>
        <p class="px-3">
            Rol del usuario.
        </p>
        <div class="container-fluid">
            <div class="row">
                <!--Columnas :v-->
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputRolUsuario">Options</label>
                    <select class="form-select" id="inputRolUsuario">
                        <option selected>Rol de usuario...</option>
                        <option value="Trabajador">Trabajador</option>
                        <option value="Encargado">Encargado</option>
                        <option value="Servicio extra">Servicio extra</option>
                    </select>
                </div>
            </div>
        </div>
    @endslot
    @slot('footerModal')
        <button type="button" class="btn btn-light d-flex ps-3 pe-3" data-bs-dismiss="modal">
            <span class="me-2">&#10060;</span>
            Cancelar
        </button>
        <button type="button" class="btn btn-light d-flex ps-3 pe-3">
            <span class="me-2">&#10004;</span>
            Registrar
        </button>
    @endslot
    @endcomponent
@endsection
@section('scritps')
    <script src="./js/validaciones/usuarios.js"></script>
@endsection

<!--En esta seccion van los scripts para cada una de las vistas
@section('scritps')
    
        En esta parte, van los scripts, pero van en una carpeta aparte,
        esa carpeta la iba a crear Omar, el chiste es que no se escriba Codigo de 
        Javascript con el de PHP, sino que se coloque en otro archivo y que lo cargue al
        ultimo. 
    
    <script >
        //Esto es un objeto, bueno, una manera de hacerlos
        const expresionesRegulares = {
            idUsuario: /^USU-[0-9]{3}-[A-Z]{3}$/, //Esto puede cambiar
            nombreUsuario:/^[A-Z][a-z]{2,25}$/, //Los nombres solo pueden iniciar con mayusculas.
            password: /^[A-Za-z0-9\_]{8,20}$/ //Contraseñas

            //(([A-Z]+[a-z]+[0-9]+)|([A-Z]*[a-z]*[0-9]*))+
        };

        //Optenemos los input del formulario
        const inputIDusuario = document.getElementById('inputIDUsuario');
        const inputNombreUsuario = document.getElementById('inputNombreUsuario');
        const inputPasswordUsuario = document.getElementById('inputPasswordUsuario');
        const inputPasswordUsuarioCon = document.getElementById('inputPasswordUsuarioCon');

        //Definimos la funcion que evaluara la expresion regular.
        function evaluar(element,expresion){
            let cadena = element.target.value;//Optenemos el valor del input
            if(expresion.test(cadena)){
                //Si la expresion coincide, se pone en verde
                element.target.classList.add('is-valid') 
                element.target.classList.remove('is-invalid')  
            }else{
                //Agregamos una lista al input para que se ponga en rojo
                element.target.classList.add('is-invalid')
                element.target.classList.remove('is-valid')    
            }      
        }

        //Agregamos el vento escuchador "cuando una tecla se levanta"
        inputIDusuario.addEventListener('keyup',e => evaluar(e,expresionesRegulares.idUsuario));
        inputNombreUsuario.addEventListener('keyup',e => evaluar(e,expresionesRegulares.nombreUsuario));
        inputPasswordUsuario.addEventListener('keyup',e => evaluar(e,expresionesRegulares.password));
        inputPasswordUsuarioCon.addEventListener('keyup',e => evaluar(e,expresionesRegulares.password));


    </script>
@endsection
-->