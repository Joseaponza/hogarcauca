<?php

class Favorite
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * Agregar una propiedad a favoritos
     */
    public function add($usuario_id, $propiedad_id)
    {
        $sql = "INSERT INTO favoritos
                (usuario_id, propiedad_id)
                VALUES (?, ?)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ii",
            $usuario_id,
            $propiedad_id
        );

        return $stmt->execute();
    }

    /**
     * Eliminar una propiedad de favoritos
     */
    public function remove($usuario_id, $propiedad_id)
    {
        $sql = "DELETE FROM favoritos
                WHERE usuario_id = ?
                AND propiedad_id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ii",
            $usuario_id,
            $propiedad_id
        );

        return $stmt->execute();
    }

    /**
     * Verificar si una propiedad
     * está en favoritos
     */
    public function exists($usuario_id, $propiedad_id)
    {
        $sql = "SELECT id
                FROM favoritos
                WHERE usuario_id = ?
                AND propiedad_id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ii",
            $usuario_id,
            $propiedad_id
        );

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->num_rows > 0;
    }

    /**
     * Obtener favoritos de un usuario
     */
    public function getByUser($usuario_id)
    {
        $sql = "SELECT propiedades.*
                FROM favoritos
                INNER JOIN propiedades
                ON favoritos.propiedad_id = propiedades.id
                WHERE favoritos.usuario_id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "i",
            $usuario_id
        );

        $stmt->execute();

        $resultado = $stmt->get_result();

        $favoritos = [];

        while ($fila = $resultado->fetch_assoc()) {

            $favoritos[] = $fila;
        }

        return $favoritos;
    }
}
