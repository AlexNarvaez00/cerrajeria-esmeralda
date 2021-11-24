@extends('rootview')
@section('header-seccion')
  @component('components.header')
    <!--Items de la barra de menu-->
    @slot('items')
      <li class="nav-item">
        <a class="nav-link text-dark" href="/login">login</a>
      </li>      
    @endslot
    <!--Esta parte es para mostrar el boton de log out-->
    @slot('visible',false)
  @endcomponent
@endsection
@section('contenido')
<main class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="card mb-3 col-12">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="./img/acerca-de.png" width="200" height="200" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Antecedentes</h5>
                <p class="card-text">La cerrajería "Esmeralda" ubicada en calle obsidiana, S/N, hacienda blanca, 
                    fraccionamiento Esmeralda, Oaxaca de Juárez, Oax., es un micro negocio que va en aumento con el paso del tiempo, 
                    lleva ofreciendo sus servicios hace más de 9 años. Este micronegocio ofrece servicios de aperturas de puertas
                    de cualquier tipo, ofrece productos como llaveros, chapas, duplicados de llaves, chips para abrir puertas de 
                    coches automáticos, entre otros productos. </p>        
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="row d-flex flex-row bd-highlight mb-3 justify-content-center">
       
        <div class="card col-3" style="width: 18rem;">
        <img src="./img/mision.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Misión</h5>
            <p class="card-text">Nuestra misión es otorgar un servicio profesional de cerrajería,
                utilizando materiales y mano de obra de calidad y especializada para que usted, como cliente,
                quede satisfecho y vea en nosotros una empresa comprometida en solucionar sus necesidades de seguridad.</p>
        </div>
        </div>
        

        <div class="card col-3 offset-md-1" style="width: 18rem;">
        <img src="./img/vision.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Visión</h5>
            <p class="card-text">Convertirnos en la cerrajería más confiable e incrementar nuestro número de clientes 
                y sucursales gracias a la eficiencia y excelencia en el servicio.</p>
        </div>
        </div>

        <div class="card col-3 offset-md-1" style="width: 18rem;">
        <img src="./img/objetivo.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Objetivo</h5>
            <p class="card-text">Suministrar productos y servicios que satisfagan las necesidades de nuestros clientes</p>
        </div>
        </div>
    </div>
</div>








@endsection
