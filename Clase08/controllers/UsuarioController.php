<?php
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioController {
    private $model;

    public function __construct($db) {
        $this->model = new Usuario($db);
    }

    // LISTAR
    public function index() {
        $usuarios = $this->model->obtener();
        require __DIR__ . "/../views/listar.php";
    }

    // CREAR
    public function crear() {
        if ($_POST) {
            $this->model->nombre = $_POST['nombre'];
            $this->model->correo = $_POST['correo'];

            $this->model->crear();
            header("Location: index.php");
            exit();
        }

        require __DIR__ . "/../views/crear.php";
    }

    // EDITAR
    public function editar() {
        $this->model->id = $_GET['id'];
        $usuario = $this->model->obtenerPorId();

        if ($_POST) {
            $this->model->id = $_POST['id'];
            $this->model->nombre = $_POST['nombre'];
            $this->model->correo = $_POST['correo'];

            $this->model->actualizar();
            header("Location: index.php");
            exit();
        }

        require __DIR__ . "/../views/editar.php";
    }

    // ELIMINAR
    public function eliminar() {
        $this->model->id = $_GET['id'];
        $this->model->eliminar();

        header("Location: index.php");
        exit();
    }
}