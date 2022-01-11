<div class="container-fluid bg-warning shadow-sm">
        <header class="px-3">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container-fluid px-5">
                    <!--Logo -->
                    <a class="navbar-brand fw-bold d-flex align-items-center" href="../home">
                        <span class="fs-1 me-2"> <i class="bi bi-key"></i> </span>
                         Cerrajeria Esmeralda
                    </a>
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
                </div>
            </nav>
        </header>
    </div>
