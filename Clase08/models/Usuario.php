<?php
class Usuario {
    private $conn;
    private $table = "usuarios";

    public $id;
    public $nombre;
    public $correo;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 📄 LISTAR
    public function obtener() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // ➕ CREAR
    public function crear() {
        $query = "INSERT INTO " . $this->table . " (nombre, correo) VALUES (:nombre, :correo)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":correo", $this->correo);

        return $stmt->execute();
    }

    // 🔍 OBTENER UNO
    public function obtenerPorId() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✏️ ACTUALIZAR
    public function actualizar() {
        $query = "UPDATE " . $this->table . " 
                  SET nombre = :nombre, correo = :correo 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // ❌ ELIMINAR
    public function eliminar() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}