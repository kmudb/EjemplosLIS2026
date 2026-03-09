<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Producto;
use mysqli;

class ProductoRepository
{
    public function __construct(private mysqli $db) {}

    /** @return array<int, array<string, mixed>> */
    public function allWithCategoria(): array
    {
        $sql = "
            SELECT p.id, p.nombre, p.precio, p.stock, p.creado_en,
                   c.nombre AS categoria
            FROM productos p
            INNER JOIN categorias c ON c.id = p.categoria_id
            ORDER BY p.creado_en DESC
        ";
        $result = $this->db->query($sql);

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            // Normalizar tipos
            $row['id'] = (int)$row['id'];
            $row['precio'] = (float)$row['precio'];
            $row['stock'] = (int)$row['stock'];
            $rows[] = $row;
        }
        return $rows;
    }

    public function create(Producto $producto): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO productos (nombre, precio, categoria_id, stock)
            VALUES (?, ?, ?, ?)
        ");
        // s d i i : string, double, int, int
        $stmt->bind_param("sdii", $producto->nombre, $producto->precio, $producto->categoriaId, $producto->stock);
        $stmt->execute();
        return $this->db->insert_id;
    }
}