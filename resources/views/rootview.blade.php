<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document @yield('titulopagina')</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body>
    <!--Barra de navegacion -->
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <!--Logo -->
                    <a class="navbar-brand fw-bold text-dark" href="">Esmeralda</a>
                    <!--Boton de hamburguesa-->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!--botones de la barra de navegacion-->
                    <div class=" navbar-collapse" id="navbarNav">
                        <!--Lista d elos botones de la barra de navegacion-->
                        <ul class="navbar-nav">
                                @yield('itemsmenu')
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>

    <!--Resto del contenido-->
    <div class="container">
        @yield('contenido')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>