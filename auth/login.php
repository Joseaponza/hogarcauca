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
    $result = (new AuthController())->login($_POST['email'] ?? '', $_POST['password'] ?? '');
    $message = $result['message'];
    $messageType = $result['success'] ? 'success' : 'error';

    if ($result['success']) {
        header('Location: ../users/profile.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | HogarCauca</title>
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
                <a href="register.php" class="btn-login">Registrarse</a>
            </nav>
        </div>
    </header>

    <main class="auth-page">
        <div class="auth-layout">
            <aside class="auth-visual">
                <img class="auth-visual-image" src="../public/images/casas/casa1.jpg" alt="">
                <div class="auth-visual-content">
                    <span class="auth-visual-label">HOGARCAUCA · TU PRÓXIMO HOGAR</span>
                    <h2>Un buen lugar puede cambiarlo todo.</h2>
                    <p>Encuentra espacios para vivir tus mejores momentos.</p>
                    <div class="auth-visual-caption">
                        <span class="auth-caption-mark" aria-hidden="true">⌂</span>
                        <span>Encuentra tu lugar en el Cauca</span>
                    </div>
                </div>
            </aside>

            <section class="auth-panel" aria-labelledby="auth-title">
                <div class="auth-card">
                    <div class="auth-header">
                        <span class="auth-eyebrow">QUÉ BUENO TENERTE DE VUELTA</span>
                        <h1 id="auth-title">Inicia sesión</h1>
                        <p class="auth-description">Ingresa a tu cuenta para continuar buscando tu próximo hogar.</p>
                    </div>

                    <?php if ($message !== ''): ?>
                        <div class="alert <?php echo $messageType === 'success' ? 'success' : 'error'; ?>"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>

                    <form method="POST" class="form-grid auth-form">
                        <label>
                            Correo electrónico
                            <input type="email" name="email" required placeholder="tu@correo.com" autocomplete="username">
                        </label>

                        <label>
                            Contraseña
                            <input type="password" name="password" required placeholder="••••••••" autocomplete="current-password">
                        </label>

                        <button type="submit" class="btn-primary">Entrar a mi cuenta</button>
                    </form>

                    <p class="auth-link">¿Aún no tienes cuenta? <a href="register.php">Crea una gratis</a></p>
                </div>
            </section>
        </div>
    </main>
</body>
</html>