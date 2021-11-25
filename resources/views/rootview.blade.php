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
    @yield('header-seccion')
    <!--Resto del contenido-->
    <div class="container">
        @yield('contenido')
    </div>

    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <script src="js/bootstrap.bundle.js"></script>
    @yield('scritps')
</body>

</html>