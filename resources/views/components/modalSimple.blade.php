<div class="">
    <!--
    Este es el contenedor del modal, lo hice asi, :v por quie 
    necesita propiedades extras, fue lo unico que se me corrio.
-->
    <div class="modal fade" id="{{$idModal}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">{{$tituloModal}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{$cuerpoModal}}
                </div>
                <div class="modal-footer">
                    {{$footerModal}}
                    <!--
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
                            -->
                </div>
            </div>
        </div>
    </div>
</div>