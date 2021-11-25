<!doctype html>
<html lang="es">
  <head>
  <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="css/bootstrap.css">

    <title>Cerrajeria Profesional Esmeralda</title>
  </head>
  <body>
    <h1 class="text-black"><svg xmlns="http://www.w3.org/2000/svg" width="55" height="49" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
  <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg>Cerrajeria Profesional Esmeralda</h1>
    <div class="conteiner">
        @yield('contenido')
    </div>

    <!--script comantado-->
    <!-- <script src=".js/bootstrap.bundle.js"></script> -->
    @yield('scritps')
  </body>
</html>