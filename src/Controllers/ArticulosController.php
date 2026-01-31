<?php

require_once __DIR__ . '/../Models/ArticulosModel.php';

class ArticulosController
{
    private $model;

    public function __construct()
    {
        $this->model = new ArticulosModel();
    }

    public function index()
    {
        $articulos = $this->model->getAll();
        require_once __DIR__ . '/../Views/articulos/index.php';
    }

    public function crear()
    {
        require_once __DIR__ . '/../Views/articulos/crear.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crear($_POST);
            header('Location: /articulos');
            exit;
        }
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $articulo = $this->model->getById($id);
            require_once __DIR__ . '/../Views/articulos/editar.php';
        }
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $this->model->actualizar($id, $_POST);
            header('Location: /articulos');
            exit;
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->eliminar($id);
        }
        header('Location: /articulos');
        exit;
    }

    public function api()
    {
        header('Content-Type: application/json');
        $articulos = $this->model->getAll();
        echo json_encode($articulos);
    }
}
