<?php

class NombresModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM nombres ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM nombres WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($datos)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO nombres (nombre, apellidos, email, telefono) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $datos['nombre'],
            $datos['apellidos'],
            $datos['email'],
            $datos['telefono']
        ]);
    }

    public function actualizar($id, $datos)
    {
        $stmt = $this->db->prepare(
            "UPDATE nombres SET nombre = ?, apellidos = ?, email = ?, telefono = ? WHERE id = ?"
        );
        return $stmt->execute([
            $datos['nombre'],
            $datos['apellidos'],
            $datos['email'],
            $datos['telefono'],
            $id
        ]);
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM nombres WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
