
<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Property.php';

class PropertyController
{
    public function index()
    {
        try {
            $conexion = Database::getConnection();
            $modelo = new Property($conexion);

            return $modelo->getAll();
        } catch (Throwable $e) {
            return [];
        }
    }

    public function show($id)
    {
        try {
            $conexion = Database::getConnection();
            $modelo = new Property($conexion);

            return $modelo->findById((int) $id);
        } catch (Throwable $e) {
            return null;
        }
    }

    public function create($datos)
    {
        $datos = is_array($datos) ? $datos : [];

        if (empty($datos['titulo']) || empty($datos['descripcion']) || empty($datos['tipo']) || empty($datos['operacion'])) {
            return ['success' => false, 'message' => 'Faltan datos obligatorios de la propiedad.'];
        }

        try {
            $conexion = Database::getConnection();
            $modelo = new Property($conexion);
            $datos['usuario_id'] = (int) ($datos['usuario_id'] ?? 1);
            $datos['precio'] = (float) ($datos['precio'] ?? 0);
            $datos['habitaciones'] = (int) ($datos['habitaciones'] ?? 0);
            $datos['banos'] = (int) ($datos['banos'] ?? 0);
            $datos['area'] = (int) ($datos['area'] ?? 0);
            $datos['imagen'] = $datos['imagen'] ?? 'public/images/logo.png';

            $guardado = $modelo->create($datos);

            if ($guardado) {
                return ['success' => true, 'message' => 'Propiedad publicada correctamente.'];
            }

            return ['success' => false, 'message' => 'No se pudo guardar la propiedad.'];
        } catch (Throwable $e) {
            return ['success' => false, 'message' => 'Error del sistema: ' . $e->getMessage()];
        }
    }

    public function update($id, $datos)
    {
        $datos = is_array($datos) ? $datos : [];

        try {
            $conexion = Database::getConnection();
            $modelo = new Property($conexion);
            $guardado = $modelo->update((int) $id, $datos);

            return $guardado;
        } catch (Throwable $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $conexion = Database::getConnection();
            $modelo = new Property($conexion);

            return $modelo->delete((int) $id);
        } catch (Throwable $e) {
            return false;
        }
    }

    public function search($filtros = [])
    {
        $filtros = is_array($filtros) ? $filtros : [];

        try {
            $conexion = Database::getConnection();
            $modelo = new Property($conexion);

            return $modelo->search(
                $filtros['operation'] ?? '',
                $filtros['type'] ?? '',
                $filtros['city'] ?? ''
            );
        } catch (Throwable $e) {
            return [];
        }
    }
}

?>
```
