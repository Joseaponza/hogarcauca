<?php
session_start();

require_once __DIR__ . '/../controllers/PropertyController.php';

$filters = [
    'operation' => $_GET['operation'] ?? '',
    'type' => $_GET['type'] ?? '',
    'city' => $_GET['city'] ?? '',
];

$properties = (new PropertyController())->search($filters);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades | HogarCauca</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container navbar-content">
            <a href="../index.php" class="logo">Hogar<span>Cauca</span></a>
            <nav class="nav-menu">
                <a href="index.php">Propiedades</a>
                <a href="create.php">Publicar</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="../users/profile.php" class="btn-login">Mi perfil</a>
                <?php else: ?>
                    <a href="../auth/login.php" class="btn-login">Iniciar sesión</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container page-content">
        <section class="page-header">
            <div>
                <span class="section-tag">INMUEBLES</span>
                <h1>Propiedades disponibles</h1>
            </div>
            <a href="create.php" class="btn-primary">Publicar inmueble</a>
        </section>

        <form class="search-box search-box-inline" method="GET" action="index.php">
            <div class="search-field">
                <label for="operation">Operación</label>
                <select name="operation" id="operation">
                    <option value="">Todas</option>
                    <option value="venta" <?php echo ($filters['operation'] === 'venta') ? 'selected' : ''; ?>>Comprar</option>
                    <option value="arriendo" <?php echo ($filters['operation'] === 'arriendo') ? 'selected' : ''; ?>>Arrendar</option>
                </select>
            </div>

            <div class="search-field">
                <label for="type">Tipo</label>
                <select name="type" id="type">
                    <option value="">Todos</option>
                    <option value="casa" <?php echo ($filters['type'] === 'casa') ? 'selected' : ''; ?>>Casa</option>
                    <option value="apartamento" <?php echo ($filters['type'] === 'apartamento') ? 'selected' : ''; ?>>Apartamento</option>
                    <option value="lote" <?php echo ($filters['type'] === 'lote') ? 'selected' : ''; ?>>Lote</option>
                    <option value="local" <?php echo ($filters['type'] === 'local') ? 'selected' : ''; ?>>Local</option>
                </select>
            </div>

            <div class="search-field">
                <label for="city">Ciudad</label>
                <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($filters['city']); ?>" placeholder="Ej. Popayán">
            </div>

            <button type="submit" class="btn-search">Filtrar</button>
        </form>

        <section class="property-grid property-grid-large">
            <?php if (empty($properties)): ?>
                <div class="empty-state">
                    <h3>No hay propiedades con esos filtros.</h3>
                    <p>Prueba con otra ciudad, tipo o operación.</p>
                </div>
            <?php else: ?>
                <?php foreach ($properties as $property): ?>
                    <?php $image = !empty($property['imagen']) ? $property['imagen'] : '../public/images/logo.png'; ?>
                    <article class="property-card">
                        <div class="property-image">
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($property['titulo']); ?>">
                            <span class="property-badge <?php echo $property['operacion'] === 'arriendo' ? 'rent' : ''; ?>"><?php echo $property['operacion'] === 'arriendo' ? 'Arriendo' : 'Venta'; ?></span>
                            <button class="favorite" type="button" title="Agregar a favoritos">♡</button>
                        </div>
                        <div class="property-info">
                            <span class="property-type"><?php echo strtoupper(htmlspecialchars($property['tipo'])); ?></span>
                            <h3><a href="show.php?id=<?php echo (int) $property['id']; ?>"><?php echo htmlspecialchars($property['titulo']); ?></a></h3>
                            <p class="property-location">📍 <?php echo htmlspecialchars($property['ciudad']); ?>, Cauca</p>
                            <div class="property-details">
                                <span> <?php echo (int) $property['habitaciones']; ?> hab.</span>
                                <span> <?php echo (int) $property['banos']; ?> baños</span>
                                <span> <?php echo (int) $property['area']; ?> m²</span>
                            </div>
                            <strong class="property-price">$<?php echo number_format((float) $property['precio'], 0, ',', '.'); ?></strong>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>