<?php
session_start();

require_once __DIR__ . '/../controllers/PropertyController.php';

$id = (int) ($_GET['id'] ?? 0);
$property = (new PropertyController())->show($id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $property ? htmlspecialchars($property['titulo']) : 'Propiedad no encontrada'; ?> | HogarCauca</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container navbar-content">
            <a href="../index.php" class="logo">Hogar<span>Cauca</span></a>
            <nav class="nav-menu">
                <a href="index.php">Propiedades</a>
                <a href="create.php">Publicar</a>
                <a href="../auth/login.php" class="btn-login">Iniciar sesión</a>
            </nav>
        </div>
    </header>

    <main class="container page-content">
        <?php if (!$property): ?>
            <div class="empty-state">
                <h1>Propiedad no encontrada</h1>
                <p>La propiedad que buscas no existe o fue eliminada.</p>
                <a href="index.php" class="btn-primary">Volver a propiedades</a>
            </div>
        <?php else: ?>
            <article class="property-detail">
                <div class="property-detail-image">
                    <img src="<?php echo !empty($property['imagen']) ? htmlspecialchars($property['imagen']) : '../public/images/logo.png'; ?>" alt="<?php echo htmlspecialchars($property['titulo']); ?>">
                </div>
                <div class="property-detail-info">
                    <span class="section-tag"><?php echo strtoupper(htmlspecialchars($property['operacion'])); ?></span>
                    <h1><?php echo htmlspecialchars($property['titulo']); ?></h1>
                    <p class="property-price detail-price">$<?php echo number_format((float) $property['precio'], 0, ',', '.'); ?></p>
                    <p class="property-location">📍 <?php echo htmlspecialchars($property['ciudad']); ?>, <?php echo htmlspecialchars($property['direccion'] ?? 'Cauca'); ?></p>

                    <div class="property-detail-meta">
                        <span> <?php echo (int) $property['habitaciones']; ?> habitaciones</span>
                        <span> <?php echo (int) $property['banos']; ?> baños</span>
                        <span> <?php echo (int) $property['area']; ?> m²</span>
                        <span> <?php echo ucfirst(htmlspecialchars($property['tipo'])); ?></span>
                    </div>

                    <div class="property-description">
                        <h3>Descripción</h3>
                        <p><?php echo nl2br(htmlspecialchars($property['descripcion'])); ?></p>
                    </div>

                    <div class="detail-actions">
                        <a href="index.php" class="btn-secondary">Volver</a>
                        <a href="../auth/login.php" class="btn-primary">Contactar</a>
                    </div>
                </div>
            </article>
        <?php endif; ?>
    </main>
</body>
</html>