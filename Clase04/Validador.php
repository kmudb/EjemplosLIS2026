<?php

class Validador {

    private array $datos;
    private array $errores = [];
    private array $datosLimpios = [];

    public function __construct(array $datos) {
        $this->datos = $datos;
    }

    public function procesar(): array {
        $this->limpiarDatos();
        $this->validarNombre();
        $this->validarEmail();
        $this->validarTelefono();
        $this->validarPassword();
        $this->detectarProveedorCorreo();

        return [
            "errores" => $this->errores,
            "datos"   => $this->datosLimpios
        ];
    }

    // 🔹 Regex para limpiar y normalizar
    private function limpiarDatos(): void {
        $this->datosLimpios['nombre'] = preg_replace(
            "/\s+/", " ",
            trim($this->datos['nombre'])
        );

        // Elimina todo excepto números
        $this->datosLimpios['telefono'] = preg_replace(
            "/[^0-9]/", "",
            $this->datos['telefono']
        );

        $this->datosLimpios['email'] = strtolower(trim($this->datos['email']));
        $this->datosLimpios['password'] = $this->datos['password'];
    }

    // 🔹 Validaciones
    private function validarNombre(): void {
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,}$/", $this->datosLimpios['nombre'])) {
            $this->errores[] = "El nombre debe tener solo letras y al menos 3 caracteres";
        }
    }

    private function validarEmail(): void {
        if (!preg_match("/^[\w.-]+@([\w-]+\.)+[a-zA-Z]{2,}$/", $this->datosLimpios['email'])) {
            $this->errores[] = "Correo electrónico inválido";
        }
    }

    private function validarTelefono(): void {
        if (!preg_match("/^[0-9]{8}$/", $this->datosLimpios['telefono'])) {
            $this->errores[] = "El teléfono debe contener exactamente 8 dígitos";
        }
    }

    private function validarPassword(): void {
        if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/", $this->datosLimpios['password'])) {
            $this->errores[] = "La contraseña debe tener mayúscula, número, símbolo y mínimo 8 caracteres";
        }
    }

    // 🔹 Regex para análisis (no solo validar)
    private function detectarProveedorCorreo(): void {
        if (preg_match("/@gmail\.com$/", $this->datosLimpios['email'])) {
            $this->datosLimpios['proveedor'] = "Gmail";
        } elseif (preg_match("/@outlook\.com$/", $this->datosLimpios['email'])) {
            $this->datosLimpios['proveedor'] = "Outlook";
        } else {
            $this->datosLimpios['proveedor'] = "Otro";
        }
    }
}
