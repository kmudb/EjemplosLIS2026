<?php
// Declaración de variables
$nota1 = 8;
$nota2 = 6;
$nota3 = 7;

// Cálculo del promedio
$promedio = ($nota1 + $nota2 + $nota3) / 3;

// Mostrar el promedio
echo "El promedio del estudiante es: " . $promedio . "<br>";

// Evaluar el resultado
if ($promedio >= 7) {
    echo "Estado: Aprobado";
} elseif ($promedio >= 5) {
    echo "Estado: Recuperación";
} else {
    echo "Estado: Reprobado";
}
?>