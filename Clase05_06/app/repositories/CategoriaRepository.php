<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Categoria;
use mysqli;

class CategoriaRepository
{
    public function __construct(private mysqli $db) {}

    /** @return Categoria[] */
    public function all(): array
    {
        $sql = "SELECT id, nombre, descripcion, creado_en FROM categorias ORDER BY nombre";
        $result = $this->db->query($sql);

        $categorias = [];
        while ($row = $result->fetch_assoc()) {
            $categorias[] = new Categoria(
                (int)$row['id'],
                $row['nombre'],
                $row['descripcion'] ?? null,
                $row['creado_en'] ?? null
            );
        }
        return $categorias;
    }

    public function existsById(int $id): bool
    {
        $stmt = $this->db->prepare("SELECT 1 FROM categorias WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function create(Categoria $categoria): int
    {
        $stmt = $this->db->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
        $stmt->bind_param("ss", $categoria->nombre, $categoria->descripcion);
        $stmt->execute();
        return $this->db->insert_id;
    }
}