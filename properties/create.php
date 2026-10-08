<?php
session_start();

require_once __DIR__ . '/../controllers/PropertyController.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'usuario_id' => $_SESSION['user_id'],
        'titulo' => trim($_POST['titulo'] ?? ''),
        'descripcion' => trim($_POST['descripcion'] ?? ''),
        'tipo' => trim($_POST['tipo'] ?? ''),
        'operacion' => trim($_POST['operacion'] ?? ''),
        'precio' => (float) ($_POST['precio'] ?? 0),
        'ciudad' => trim($_POST['ciudad'] ?? ''),
        'direccion' => trim($_POST['direccion'] ?? ''),
        'habitaciones' => (int) ($_POST['habitaciones'] ?? 0),
        'banos' => (int) ($_POST['banos'] ?? 0),
        'area' => (int) ($_POST['area'] ?? 0),
        'imagen' => trim($_POST['imagen'] ?? '') !== '' ? trim($_POST['imagen'] ?? '') : '../public/images/logo.png'
    ];

    $resultado = (new PropertyController())->create($datos);
    $message = $resultado['message'];
    $messageType = $resultado['success'] ? 'success' : 'error';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar inmueble | HogarCauca</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container navbar-content">
            <a href="../index.php" class="logo">Hogar<span>Cauca</span></a>
            <nav class="nav-menu">
                <a href="index.php">Propiedades</a>
                <a href="create.php">Publicar</a>
                <a href="../users/profile.php" class="btn-login">Mi perfil</a>
            </nav>
        </div>
    </header>

    <main class="container page-content">
        <section class="auth-card form-card">
            <div class="auth-header">
                <span class="section-tag">PUBLICAR</span>
                <h1>Registrar una propiedad</h1>
            </div>

            <?php if ($message !== ''): ?>
                <div class="alert <?php echo $messageType === 'success' ? 'success' : 'error'; ?>"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form method="POST" class="form-grid">
                <label>
                    Título
                    <input type="text" name="titulo" required placeholder="Ej. Casa moderna en Popayán">
                </label>

                <label>
                    Tipo de inmueble
                    <select name="tipo" required>
                        <option value="">Selecciona</option>
                        <option value="casa">Casa</option>
                        <option value="apartamento">Apartamento</option>
                        <option value="lote">Lote</option>
                        <option value="local">Local comercial</option>
                    </select>
                </label>

                <label>
                    Operación
                    <select name="operacion" required>
                        <option value="">Selecciona</option>
                        <option value="venta">Venta</option>
                        <option value="arriendo">Arriendo</option>
                    </select>
                </label>

                <label>
                    Precio
                    <input type="number" name="precio" min="0" step="1000" required placeholder="280000000">
                </label>

                <label>
                    Ciudad
                    <input type="text" name="ciudad" required placeholder="Popayán">
                </label>

                <label>
                    Dirección
                    <input type="text" name="direccion" required placeholder="Cra 12 # 34-56">
                </label>

                <label>
                    Habitaciones
                    <input type="number" name="habitaciones" min="0" value="0">
                </label>

                <label>
                    Baños
                    <input type="number" name="banos" min="0" value="0">
                </label>

                <label>
                    Área en m²
                    <input type="number" name="area" min="0" value="0">
                </label>

                <label class="full-width">
                    Descripción
                    <textarea name="descripcion" rows="5" required placeholder="Describe la propiedad..."></textarea>
                </label>

                <label class="full-width">
                    URL de la imagen (opcional)
                    <input type="text" name="imagen" placeholder="https://.../imagen.jpg">
                </label>

                <button type="submit" class="btn-primary full-width">Publicar propiedad</button>
            </form>
        </section>
    </main>
</body>
</html>