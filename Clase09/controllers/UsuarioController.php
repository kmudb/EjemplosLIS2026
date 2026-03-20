<?php
session_start();

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioController {

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = new Database();
            $conn = $db->conectar();
            $usuarioModel = new Usuario($conn);

            $usuario = $_POST["usuario"];
            $password = $_POST["password"];

            $user = $usuarioModel->login($usuario, $password);

            if ($user) {
                $_SESSION["usuario"] = $user["usuario"];
                $_SESSION["id"] = $user["id"];
                $_SESSION["rol"] = $user["rol"];

        if ($user["rol"] === "admin") {
    header("Location: http://localhost/EjemplosLIS2026/Clase09/views/bienvenida_admin.php");
    exit();
} else {
    header("Location: http://localhost/EjemplosLIS2026/Clase09/views/bienvenida_usuario.php");
    exit();
}
                exit();
            } else {
                header("Location: ../views/login.php?error=1");
                exit();
            }
        }
    }

    public function registrar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = new Database();
            $conn = $db->conectar();
            $usuarioModel = new Usuario($conn);

            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $rol = $_POST["rol"] ?? "usuario";

            if($usuarioModel->registrar($usuario, $password, $rol)) {
                header("Location:http://localhost/EjemplosLIS2026/Clase09/views/login.php?mensaje=registrado");
                exit();
            } else {
                header("Location: http://localhost/EjemplosLIS2026/Clase09/views/registrar.php?error=existe");
                exit();
            }
        }
    }

    public function verificarSesion($rolPermitido = null) {
        if (!isset($_SESSION["usuario"])) {
            header("Location: login.php");
            exit();
        }

        if ($rolPermitido && $_SESSION["rol"] !== $rolPermitido) {
            echo "Acceso denegado. Solo $rolPermitido puede ingresar.";
            exit();
        }
    }
}
?>