<div class="container">
    <header>
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container-fluid">
                <!--Logo -->
                <a class="navbar-brand fw-bold text-dark" href="">Esmeralda</a>
                <!--Boton de hamburguesa-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--botones de la barra de navegacion-->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <!--Lista d elos botones de la barra de navegacion-->
                    <ul class="navbar-nav">
                        {{$items}}
                    </ul>
                </div>
                <div class="container-button-end">
                    @if($visible)
                        <a class="btn btn-outline-success" href="#">Log Out</a>
                    @endif
                </div>
            </div>
        </nav>
    </header>
</div>