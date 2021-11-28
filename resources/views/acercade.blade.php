@extends('rootview')
@section('header-seccion')
@component('components.header')
<!--Items de la barra de menu-->
@slot('items')
<li class="nav-item">
  <a class="btn btn-outline-success" href="/login">Iniciar sesión</a>
</li>
@endslot
<!--Esta parte es para mostrar el boton de log out-->
@slot('visible',false)
@endcomponent
@endsection
@section('contenido')
<main class="container">
  <h5 class="h5 mt-5">Acerca de nosotros ...</h5>
  <hr class="mt-5"/>

  <div class="row d-flex justify-content-center align-items-center mt-5">
    <div class="card mb-3 col-12">
      <div class="row g-0 p-4">
        <div class="col-md-4 d-flex justify-content-center align-items-center">
          <img src="./img/acerca-de.png" width="150" height="150" class="" alt="...">
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

  <div class="row d-flex flex-row bd-highlight mb-3 justify-content-center mt-5">

    <div class="col-md-4 col-sm-12 mb-3">
      <div class="card d-flex align-items-center pt-4">
          <img src="./img/mision.png" class="card-img-top" alt="..." style="width: 170px; height: 170px;">
          <div class="card-body">
            <h5 class="card-title">Misión</h5>
            <p class="card-text">Nuestra misión es otorgar un servicio profesional de cerrajería,
              utilizando materiales y mano de obra de calidad y especializada para que usted, como cliente,
              quede satisfecho y vea en nosotros una empresa comprometida en solucionar sus necesidades de seguridad.</p>
          </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
      <div class="card d-flex align-items-center pt-4" >
        <img src="./img/vision.png" class="card-img-top" alt="..." style="width: 170px; height: 170px;">
        <div class="card-body">
          <h5 class="card-title">Visión</h5>
          <p class="card-text">Convertirnos en la cerrajería más confiable e incrementar nuestro número de clientes
            y sucursales gracias a la eficiencia y excelencia en el servicio.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-12 mb-3">
      <div class="card d-flex align-items-center pt-4">
        <img src="./img/objetivo.png" class="card-img-top" alt="..." style="width: 170px; height: 170px;">
        <div class="card-body">
          <h5 class="card-title">Objetivo</h5>
          <p class="card-text">Suministrar productos y servicios que satisfagan las necesidades de nuestros clientes</p>
        </div>
      </div>
    </div>
  </div>
</div>





<footer class="container-fluid mt-5 bg-primary">
  <div class="container">
    <div class="row py-5">
      <div class="col-md-3 col-sm-6">
        <h5 class="h5 text-white ps-3">Redes sociales</h5>
        <ul class="list-unstyled">
          <li class="p-2">

          <img src="./img/facebook.png"> <a href="https://www.facebook.com/CerrajeroProfecional" class="text-white text-decoration-none p-2">Cerrajeria profesional Esmeralda</a>
          </li>          

          

        </ul>
      </div>
      <div class="col-md-3 col-sm-6">
        <h5 class="h5 text-white ps-3">Télefonos de contacto.</h5>
        <ul class="list-unstyled">
          <li class="p-2">

            <a href="#1" class="text-white text-decoration-none p-2">951-146-8141</a>
          </li>         

        </ul>
      </div>
      <div class="col-md-3 col-sm-6">
        <h5 class="h5 text-white ps-3">Equipo de desarrollo.</h5>
        <ul class="list-unstyled">
          <li class="p-2">

            <a href="#1" class="text-white text-decoration-none p-2">Alexis Narvaez</a>
          </li>
          <li class="p-2">
            <a href="#2" class="text-white text-decoration-none p-2">Roberto Vazquez</a>
          </li>
          <li class="p-2">
            <a href="#3" class="text-white text-decoration-none p-2">Jennifer Martinez</a>
          </li>
          <li class="p-2">
            <a href="#3" class="text-white text-decoration-none p-2">Dafne Santiago</a>
          </li>
          <li class="p-2">
            <a href="#3" class="text-white text-decoration-none p-2">Omar Silverio</a>            
          </li>          
        </ul>
      </div>
    </div>
  </div>
</footer>

@endsection