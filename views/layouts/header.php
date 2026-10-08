<?php
$basePath = '/';
?>
<header class="navbar">
    <div class="container navbar-content">
        <a href="<?php echo $basePath; ?>index.php" class="logo">Hogar<span>Cauca</span></a>
        <nav class="nav-menu">
            <a href="<?php echo $basePath; ?>properties/index.php?operation=venta">Comprar</a>
            <a href="<?php echo $basePath; ?>properties/index.php?operation=arriendo">Arrendar</a>
            <a href="<?php echo $basePath; ?>properties/create.php">Publicar inmueble</a>
            <a href="<?php echo $basePath; ?>auth/login.php" class="btn-login">Iniciar sesión</a>
        </nav>
    </div>
</header>