<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Property.php';

class UserController
{
    public function show($id)
    {
        try {
            $conexion = Database::getConnection();
            $modelo = new User($conexion);

            return $modelo->findById((int) $id);
        } catch (Throwable $e) {
            return null;
        }
    }

    public function update($id, $datos)
    {
        $datos = is_array($datos) ? $datos : [];

        try {
            $conexion = Database::getConnection();
            $modelo = new User($conexion);

            return $modelo->update(
                (int) $id,
                $datos['nombre'] ?? '',
                $datos['email'] ?? '',
                $datos['telefono'] ?? ''
            );
        } catch (Throwable $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $conexion = Database::getConnection();
            $modelo = new User($conexion);

            return $modelo->delete((int) $id);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function properties($id)
    {
        try {
            $conexion = Database::getConnection();
            $sql = 'SELECT * FROM propiedades WHERE usuario_id = ? ORDER BY fecha_publicacion DESC';
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            $propiedades = [];
            while ($fila = $resultado->fetch_assoc()) {
                $propiedades[] = $fila;
            }

            return $propiedades;
        } catch (Throwable $e) {
            return [];
        }
    }
}

?>
```