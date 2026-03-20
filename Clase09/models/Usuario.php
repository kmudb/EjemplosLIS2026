<?php
class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Login seguro
    public function login($usuario, $password) {
        $sql = "SELECT * FROM usuarios WHERE usuario=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    // Registrar usuario
    public function registrar($usuario, $password, $rol = "usuario") {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Verificar si usuario existe
        $sql_check = "SELECT * FROM usuarios WHERE usuario=?";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->bind_param("s", $usuario);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if($result_check->num_rows > 0) return false;

        // Insertar usuario
        $sql = "INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $usuario, $hash, $rol);
        return $stmt->execute();
    }
}
?>