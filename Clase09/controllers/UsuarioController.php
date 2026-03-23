<?php
session_start();
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioController
{
    private $usuarioModel;

    public function __construct()
    {
        $db = new Database();
        $conn = $db->conectar();
        $this->usuarioModel = new Usuario($conn);
    }

    /* ======================
       LOGIN
       ====================== */
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: " . BASE_URL . "/views/login.php");
            exit();
        }

        $usuario  = trim($_POST["usuario"] ?? '');
        $password = $_POST["password"] ?? '';

        if ($usuario === '' || $password === '') {
            header("Location: " . BASE_URL . "/views/login.php?error=vacio");
            exit();
        }

        $user = $this->usuarioModel->login($usuario, $password);

        if (!$user) {
            header("Location: " . BASE_URL . "/views/login.php?error=invalido");
            exit();
        }

        // Prevención de session fixation
        session_regenerate_id(true);

        $_SESSION["id"]      = $user["id"];
        $_SESSION["usuario"] = $user["usuario"];
        $_SESSION["rol"]     = $user["rol"];

        if ($user["rol"] === "admin") {
            header("Location: " . BASE_URL . "/views/bienvenida_admin.php");
        } else {
            header("Location: " . BASE_URL . "/views/bienvenida_usuario.php");
        }
        exit();
    }

    /* ======================
       REGISTRO
       ====================== */
    public function registrar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: registrar.php");
            exit();
        }

        $usuario  = trim($_POST["usuario"] ?? '');
        $password = $_POST["password"] ?? '';
        $rol      = $_POST["rol"] ?? "usuario";

        if ($usuario === '' || $password === '') {
            header("Location: " . BASE_URL . "/views/registrar.php?error=vacio");
            exit();
        }

        // Hash seguro de contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $registrado = $this->usuarioModel->registrar(
            $usuario,
            $passwordHash,
            $rol
        );

        if ($registrado) {
            header("Location: " . BASE_URL . "/views/login.php?mensaje=registrado");
        } else {
            header("Location: " . BASE_URL . "/views/registrar.php?error=existe");
        }
        exit();
    }

    /* ======================
       VERIFICAR SESIÓN
       ====================== */
    public function verificarSesion(string $rolPermitido = null)
    {
        if (!isset($_SESSION["usuario"])) {
            header("Location: " . BASE_URL . "/views/login.php");
            exit();
        }


    if ($rolPermitido !== null && $_SESSION["rol"] !== $rolPermitido) {
        header("HTTP/1.1 403 Forbidden");
         header("Location: " . BASE_URL . "/views/403.php");
        exit();
    }

    }

    /* ======================
       LOGOUT
       ====================== */
    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: login.php");
        exit();
    }
}