<?php
class Inventario {
    private $codigo;
    private $nombre;
    private $precio;
    private $cantidad;

    public function __construct($codigo, $nombre, $precio, $cantidad) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getTotal() {
        return $this->precio * $this->cantidad;
    }
}
