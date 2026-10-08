<?php

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            self::$connection = new mysqli(
                'localhost',
                'root',
                '',
                'hogarcauca'
            );

            if (self::$connection->connect_error) {
                throw new RuntimeException(
                    'Error de conexión con la base de datos: ' . self::$connection->connect_error
                );
            }

            self::$connection->set_charset('utf8mb4');
        }

        return self::$connection;
    }
}

?>