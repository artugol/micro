<?php

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'microframework_db';
        $user = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';
        
        try {
            // Intentar conectar con la base de datos
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $user,
                $password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            // Si la base de datos no existe, mostrar mensaje de ayuda
            if ($e->getCode() == 1049) {
                die(
                    "<h2>⚠️ Base de datos no encontrada</h2>" .
                    "<p>La base de datos '<strong>$dbname</strong>' no existe.</p>" .
                    "<p><strong>Ejecuta el instalador:</strong></p>" .
                    "<pre>php setup.php</pre>" .
                    "<p>O crea la base de datos manualmente e importa <code>database/schema.sql</code></p>"
                );
            }
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
