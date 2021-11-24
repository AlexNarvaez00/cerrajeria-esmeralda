<div class="toast fade show mb-3" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <!--
            <img src="..." class="rounded me-2" alt="...">
            -> No quise que llevara imagen por que siento que seria un desastre
    -->
    <strong class="me-auto">{{$tituloNotificacion}}</strong>
    <small>{{$tiempo}}</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    {{$descripcion}}
  </div>
</div>