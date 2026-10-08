<?php
session_start();

require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/AuthController.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

if (isset($_GET['logout'])) {
    (new AuthController())->logout();
    header('Location: ../index.php');
    exit;
}

$user = (new UserController())->show($_SESSION['user_id']);
$properties = (new UserController())->properties($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil | HogarCauca</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container navbar-content">
            <a href="../index.php" class="logo">Hogar<span>Cauca</span></a>
            <nav class="nav-menu">
                <a href="../properties/index.php">Propiedades</a>
                <a href="../properties/create.php">Publicar</a>
                <a href="profile.php?logout=1" class="btn-login">Cerrar sesión</a>
            </nav>
        </div>
    </header>

    <main class="container page-content">
        <section class="profile-summary">
            <div>
                <span class="section-tag">PERFIL</span>
                <h1><?php echo htmlspecialchars($user['nombre'] ?? 'Usuario'); ?></h1>
                <p><?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
            </div>
            <a href="../properties/create.php" class="btn-primary">Publicar inmueble</a>
        </section>

        <section class="profile-grid">
            <div class="profile-card">
                <h3>Información</h3>
                <ul>
                    <li><strong>Nombre:</strong> <?php echo htmlspecialchars($user['nombre'] ?? ''); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? ''); ?></li>
                    <li><strong>Teléfono:</strong> <?php echo htmlspecialchars($user['telefono'] ?? ''); ?></li>
                </ul>
            </div>

            <div class="profile-card">
                <h3>Propiedades publicadas</h3>
                <?php if (empty($properties)): ?>
                    <p>Aún no has publicado inmuebles.</p>
                <?php else: ?>
                    <ul class="property-list">
                        <?php foreach ($properties as $property): ?>
                            <li>
                                <a href="../properties/show.php?id=<?php echo (int) $property['id']; ?>"><?php echo htmlspecialchars($property['titulo']); ?></a>
                                <span><?php echo ucfirst(htmlspecialchars($property['operacion'])); ?> · <?php echo htmlspecialchars($property['ciudad']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>