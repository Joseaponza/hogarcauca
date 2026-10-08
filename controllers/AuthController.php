
<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function register($nombre, $email, $password, $telefono = '')
    {
        $nombre = trim((string) $nombre);
        $email = strtolower(trim((string) $email));
        $telefono = trim((string) $telefono);

        if ($nombre === '' || $email === '' || $password === '') {
            return ['success' => false, 'message' => 'Todos los campos obligatorios deben completarse.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'El correo electrónico no es válido.'];
        }

        try {
            $conexion = Database::getConnection();
            $usuarioModel = new User($conexion);

            if ($usuarioModel->findByEmail($email)) {
                return ['success' => false, 'message' => 'Ya existe un usuario registrado con ese correo.'];
            }

            $creado = $usuarioModel->create($nombre, $email, $password, $telefono);

            if ($creado) {
                return ['success' => true, 'message' => 'Usuario registrado correctamente.'];
            }

            return ['success' => false, 'message' => 'No se pudo registrar el usuario.'];
        } catch (Throwable $e) {
            return ['success' => false, 'message' => 'Error del sistema: ' . $e->getMessage()];
        }
    }

    public function login($email, $password)
    {
        $email = strtolower(trim((string) $email));
        $password = (string) $password;

        if ($email === '' || $password === '') {
            return ['success' => false, 'message' => 'Debe ingresar correo y contraseña.'];
        }

        try {
            $conexion = Database::getConnection();
            $usuarioModel = new User($conexion);
            $usuario = $usuarioModel->findByEmail($email);

            if (!$usuario || !password_verify($password, $usuario['password'])) {
                return ['success' => false, 'message' => 'Credenciales inválidas.'];
            }

            session_start();
            $_SESSION['user_id'] = (int) $usuario['id'];
            $_SESSION['user_name'] = $usuario['nombre'];
            $_SESSION['user_email'] = $usuario['email'];

            return [
                'success' => true,
                'message' => 'Inicio de sesión correcto.',
                'user' => $usuario
            ];
        } catch (Throwable $e) {
            return ['success' => false, 'message' => 'Error del sistema: ' . $e->getMessage()];
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        return true;
    }
}

?>