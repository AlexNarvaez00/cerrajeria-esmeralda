@extends('rootview')
@section('itemsmenu')
<!--Items de la barra del menu-->
    <li class="nav-item">
    <a class="nav-link text-dark" href="#">Productos</a>
    </li>
    <li class="nav-item">
    <a class="nav-link text-dark" href="#">Proveedores</a>
    </li>
    <li class="nav-item">
    <a class="nav-link text-blue" href="#">Ventas</a>  
    </li>
    <li class="nav-item">
    <a class="nav-link text-dark" href="#">Usuarios</a>
    </li>
    <li class="nav-item">
    <a class="nav-link text-dark" href="#">&#128276;    Notificaciones</a>
    </li>
@endsection

@section('contenido')
<div class="row">   
    <div class="col-2"></div>
    <div class="col-3"> &#128075; ¡Hola, XXXX XXXX XXXX!</div>    
  </div>
<div class="row">
</div>
<br>
<div class="row">
    <div class="col-2"></div>
    <div class="col-2"><b>Ventas</b></div>     
</div>
<br>
<!--
<div class="row">
    <div class="col-3 border"> 3 </div>
    <div class="col-3 border"> 3 </div>
    <div class="col-3 border"> 3 </div>  
    <div class="col-3 border"> 3 </div>  
</div>-->
@endsection