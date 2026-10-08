<?php

class Property
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * Obtener todas las propiedades
     */
    public function getAll()
    {
        $sql = "SELECT *
                FROM propiedades
                ORDER BY fecha_publicacion DESC";

        $resultado = $this->conexion->query($sql);

        $propiedades = [];

        while ($fila = $resultado->fetch_assoc()) {

            $propiedades[] = $fila;

        }

        return $propiedades;
    }

    /**
     * Obtener una propiedad por ID
     */
    public function findById($id)
    {
        $sql = "SELECT *
                FROM propiedades
                WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }

    /**
     * Crear propiedad
     */
    public function create($datos)
    {
        $sql = "INSERT INTO propiedades
                (
                    usuario_id,
                    titulo,
                    descripcion,
                    tipo,
                    operacion,
                    precio,
                    ciudad,
                    direccion,
                    habitaciones,
                    banos,
                    area,
                    imagen
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "issssdssiiis",
            $datos['usuario_id'],
            $datos['titulo'],
            $datos['descripcion'],
            $datos['tipo'],
            $datos['operacion'],
            $datos['precio'],
            $datos['ciudad'],
            $datos['direccion'],
            $datos['habitaciones'],
            $datos['banos'],
            $datos['area'],
            $datos['imagen']
        );

        return $stmt->execute();
    }

    /**
     * Actualizar propiedad
     */
    public function update($id, $datos)
    {
        $sql = "UPDATE propiedades
                SET titulo = ?,
                    descripcion = ?,
                    tipo = ?,
                    operacion = ?,
                    precio = ?,
                    ciudad = ?,
                    direccion = ?,
                    habitaciones = ?,
                    banos = ?,
                    area = ?,
                    imagen = ?
                WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ssssdssiiisi",
            $datos['titulo'],
            $datos['descripcion'],
            $datos['tipo'],
            $datos['operacion'],
            $datos['precio'],
            $datos['ciudad'],
            $datos['direccion'],
            $datos['habitaciones'],
            $datos['banos'],
            $datos['area'],
            $datos['imagen'],
            $id
        );

        return $stmt->execute();
    }

    /**
     * Eliminar propiedad
     */
    public function delete($id)
    {
        $sql = "DELETE FROM propiedades
                WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    /**
     * Buscar propiedades
     */
    public function search(
        $operation = "",
        $type = "",
        $city = ""
    ) {

        $sql = "SELECT *
                FROM propiedades
                WHERE 1=1";

        $parametros = [];
        $tipos = "";

        if (!empty($operation)) {

            $sql .= " AND operacion = ?";

            $parametros[] = $operation;

            $tipos .= "s";
        }

        if (!empty($type)) {

            $sql .= " AND tipo = ?";

            $parametros[] = $type;

            $tipos .= "s";
        }

        if (!empty($city)) {

            $sql .= " AND ciudad LIKE ?";

            $parametros[] = "%" . $city . "%";

            $tipos .= "s";
        }

        $sql .= " ORDER BY fecha_publicacion DESC";

        $stmt = $this->conexion->prepare($sql);

        if (!empty($parametros)) {

            $stmt->bind_param(
                $tipos,
                ...$parametros
            );
        }

        $stmt->execute();

        $resultado = $stmt->get_result();

        $propiedades = [];

        while ($fila = $resultado->fetch_assoc()) {

            $propiedades[] = $fila;
        }

        return $propiedades;
    }
}
