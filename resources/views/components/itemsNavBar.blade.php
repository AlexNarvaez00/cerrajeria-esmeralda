<!-- 
    {{($active == 'usuarios')?'active':''}}
            con esa instruccion, es un IF pero abrebiado, como el de Java,
            No queria hacerlo asi pero fue lo unico que se me ocurrio

 -->
<li class="nav-item">
    <a class="nav-link fs-5 {{($active == 'productos')?'active':''}}" href="../productos">Productos</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link fs-5  dropdown-toggle {{($active == 'ventas')?'active':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Ventas
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="./productos-ventas">Realizar venta de productos</a></li>
        <li><a class="dropdown-item" href="./servicios-ventas">Realizar venta de servicios</a></li>            
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link fs-5 {{($active == 'devoluciones')?'active':''}}" href="../devoluciones">Devoluciones</a>
</li>
<li class="nav-item">
    <a class="nav-link fs-5 {{($active == 'clientes')?'active':''}}" href="../clientes">Clientes</a>
</li>
<li class="nav-item">
    <a class="nav-link fs-5 {{($active == 'proveedores')?'active':''}}" href="../proveedores">Proveedores</a>
</li>
<!-- <li class="nav-item">
    <a class="nav-link fs-5 {{($active == 'usuarios')?'active':''}}" href="../usuarios">Usuarios</a>
</li> -->
<li class="nav-item dropdown">
    <a class="nav-link fs-5 dropdown-toggle {{($active == 'reportes')?'active':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Reportes
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="/reporte-venta-productos">Reportes de ventas de productos</a></li>
        <li><a class="dropdown-item" href="/reporte-ventas-servicios">Reportes ventas servicios</a></li>            
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link fs-5 {{($active == 'notificaciones')?'active':''}}" href="../notificaciones" id="btnNoificaciones">
        <span class="icon">&#128276;</span>
        Notificaciones
    </a>
</li>
<li class="nav-item dropdown {{($active == 'usuarios')?'active':''}}">
    <a class="nav-link fs-5 dropdown-toggle" href="#" id="navbarDropdownSesion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Menú
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownSesion">
        <li><a class="dropdown-item" href="../usuarios">Usuarios</a></li>
        <li>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="dropdown-item">Cerrar sesión</button>
            </form>
        </li>
    </ul>
</li>