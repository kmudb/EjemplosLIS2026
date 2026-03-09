<?php
declare(strict_types=1);

namespace App\Models;

class Producto
{
    public ?int $id;
    public string $nombre;
    public float $precio;
    public int $categoriaId;
    public int $stock;
    public ?string $creadoEn;

    public function __construct(
        ?int $id,
        string $nombre,
        float $precio,
        int $categoriaId,
        int $stock = 0,
        ?string $creadoEn = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->categoriaId = $categoriaId;
        $this->stock = $stock;
        $this->creadoEn = $creadoEn;
    }
}