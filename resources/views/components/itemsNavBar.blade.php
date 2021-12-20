<!-- 
    {{($active == 'usuarios')?'active':''}}
            con esa instruccion, es un IF pero abrebiado, como el de Java,
            No queria hacerlo asi pero fue lo unico que se me ocurrio

 -->
<li class="nav-item">
    <a class="nav-link {{($active == 'productos')?'active':''}}" href="../productos">Productos</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{($active == 'ventas')?'active':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Ventas
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="./productos-ventas">Realizar venta de productos</a></li>
        <li><a class="dropdown-item" href="./servicios-ventas">Realizar venta de servicios</a></li>            
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'clientes')?'active':''}}" href="../clientes">Clientes</a>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'proveedores')?'active':''}}" href="../proveedores">Proveedores</a>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'usuarios')?'active':''}}" href="../usuarios">Usuarios</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle {{($active == 'reportes')?'active':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Reportes
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="/reporteProductos">Reportes ventas productos</a></li>
        <li><a class="dropdown-item" href="#">Reportes ventas servicios</a></li>            
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'notificaciones')?'active':''}}" href="../notificaciones">
        <span class="icon">&#128276;</span>
        Notificaciones
    </a>
</li>