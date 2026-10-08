<?php

class User
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * Crear un nuevo usuario
     */
    public function create($nombre, $email, $password, $telefono)
    {
        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $sql = "INSERT INTO usuarios
                (nombre, email, password, telefono)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "ssss",
            $nombre,
            $email,
            $passwordHash,
            $telefono
        );

        return $stmt->execute();
    }

    /**
     * Buscar usuario por correo
     */
    public function findByEmail($email)
    {
        $sql = "SELECT *
                FROM usuarios
                WHERE email = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }

    /**
     * Buscar usuario por ID
     */
    public function findById($id)
    {
        $sql = "SELECT *
                FROM usuarios
                WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }

    /**
     * Actualizar usuario
     */
    public function update(
        $id,
        $nombre,
        $email,
        $telefono
    ) {

        $sql = "UPDATE usuarios
                SET nombre = ?,
                    email = ?,
                    telefono = ?
                WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param(
            "sssi",
            $nombre,
            $email,
            $telefono,
            $id
        );

        return $stmt->execute();
    }

    /**
     * Eliminar usuario
     */
    public function delete($id)
    {
        $sql = "DELETE FROM usuarios
                WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
