<?php

require_once __DIR__ . '/../Models/NombresModel.php';

class NombresController
{
    private $model;

    public function __construct()
    {
        $this->model = new NombresModel();
    }

    public function index()
    {
        $nombres = $this->model->getAll();
        require_once __DIR__ . '/../Views/nombres/index.php';
    }

    public function crear()
    {
        require_once __DIR__ . '/../Views/nombres/crear.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crear($_POST);
            header('Location: /nombres');
            exit;
        }
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $nombre = $this->model->getById($id);
            require_once __DIR__ . '/../Views/nombres/editar.php';
        }
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $this->model->actualizar($id, $_POST);
            header('Location: /nombres');
            exit;
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->eliminar($id);
        }
        header('Location: /nombres');
        exit;
    }

    public function api()
    {
        header('Content-Type: application/json');
        $nombres = $this->model->getAll();
        echo json_encode($nombres);
    }
}
