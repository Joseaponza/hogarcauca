<?php
session_start();

require_once __DIR__ . '/../controllers/AuthController.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ../users/profile.php');
    exit;
}

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = (new AuthController())->register(
        $_POST['nombre'] ?? '',
        $_POST['email'] ?? '',
        $_POST['password'] ?? '',
        $_POST['telefono'] ?? ''
    );

    $message = $result['message'];
    $messageType = $result['success'] ? 'success' : 'error';

    if ($result['success']) {
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | HogarCauca</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/auth.css">
</head>
<body class="page-shell">
    <header class="navbar">
        <div class="container navbar-content">
            <a href="../index.php" class="logo">Hogar<span>Cauca</span></a>
            <nav class="nav-menu">
                <a href="../properties/index.php">Propiedades</a>
                <a href="../properties/create.php">Publicar</a>
                <a href="login.php" class="btn-login">Iniciar sesión</a>
            </nav>
        </div>
    </header>

    <main class="auth-page">
        <div class="auth-layout auth-layout-register">
            <aside class="auth-visual">
                <img class="auth-visual-image" src="../public/images/casas/casa2.jpg" alt="">
                <div class="auth-visual-content">
                    <span class="auth-visual-label">HOGARCAUCA · TU PRÓXIMO HOGAR</span>
                    <h2>Todo gran comienzo necesita un lugar.</h2>
                    <p>Crea tu cuenta y descubre propiedades que se sienten como en casa.</p>
                    <div class="auth-visual-caption">
                        <span class="auth-caption-mark" aria-hidden="true">⌂</span>
                        <span>Tu próximo capítulo empieza aquí</span>
                    </div>
                </div>
            </aside>

            <section class="auth-panel" aria-labelledby="auth-title">
                <div class="auth-card">
                    <div class="auth-header">
                        <span class="auth-eyebrow">EMPIEZA A EXPLORAR</span>
                        <h1 id="auth-title">Crea tu cuenta</h1>
                        <p class="auth-description">Regístrate y encuentra el espacio ideal para tu próxima etapa.</p>
                    </div>

                    <?php if ($message !== ''): ?>
                        <div class="alert <?php echo $messageType === 'success' ? 'success' : 'error'; ?>"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>

                    <form method="POST" class="form-grid auth-form">
                        <label>
                            Nombre completo
                            <input type="text" name="nombre" required placeholder="Tu nombre" autocomplete="name">
                        </label>

                        <label>
                            Correo electrónico
                            <input type="email" name="email" required placeholder="tu@correo.com" autocomplete="email">
                        </label>

                        <label>
                            Teléfono
                            <input type="tel" name="telefono" placeholder="300 000 0000" autocomplete="tel">
                        </label>

                        <label>
                            Contraseña
                            <input type="password" name="password" required placeholder="Mínimo 6 caracteres" autocomplete="new-password">
                        </label>

                        <button type="submit" class="btn-primary">Crear mi cuenta</button>
                    </form>

                    <p class="auth-link">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
                </div>
            </section>
        </div>
    </main>
</body>
</html>