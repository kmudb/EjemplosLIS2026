<?php
declare(strict_types=1);

namespace App\Models;

class Categoria
{
    public ?int $id;
    public string $nombre;
    public ?string $descripcion;
    public ?string $creadoEn;

    public function __construct(
        ?int $id,
        string $nombre,
        ?string $descripcion = null,
        ?string $creadoEn = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->creadoEn = $creadoEn;
    }
}