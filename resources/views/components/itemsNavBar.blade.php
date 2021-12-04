<!-- 
    {{($active == 'usuarios')?'active':''}}
            con esa instruccion, es un IF pero abrebiado, como el de Java,
            No queria hacerlo asi pero fue lo unico que se me ocurrio

 -->
<li class="nav-item">
    <a class="nav-link {{($active == 'productos')?'active':''}}" href="../productos">Productos</a>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'clientes')?'active':''}}" href="../clientes">Clientes</a>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'proveedores')?'active':''}}" href="../proveedores">Proveedores</a>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'ventas')?'active':''}}" href="../ventas">Ventas</a>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'usuarios')?'active':''}}" href="../usuarios">Usuarios</a>
</li>
<li class="nav-item">
    <a class="nav-link {{($active == 'notificaciones')?'active':''}}" href="../notificaciones">
        <span class="icon">&#128276;</span>
        Notificaciones
    </a>
</li>