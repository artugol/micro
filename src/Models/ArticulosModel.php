<?php

class ArticulosModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM articulos ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM articulos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($datos)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO articulos (titulo, descripcion, precio, stock) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $datos['titulo'],
            $datos['descripcion'],
            $datos['precio'],
            $datos['stock']
        ]);
    }

    public function actualizar($id, $datos)
    {
        $stmt = $this->db->prepare(
            "UPDATE articulos SET titulo = ?, descripcion = ?, precio = ?, stock = ? WHERE id = ?"
        );
        return $stmt->execute([
            $datos['titulo'],
            $datos['descripcion'],
            $datos['precio'],
            $datos['stock'],
            $id
        ]);
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM articulos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
