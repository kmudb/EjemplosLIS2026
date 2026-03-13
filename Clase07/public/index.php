<?php
// public/index.php

// Autocarga simple (si no usas Composer). Incluye helpers para vistas.
require_once __DIR__ . '/../src/Database.php';

// Helpers
function render(string $view, array $data = [])
{
    extract($data);
    $viewFile = __DIR__ . '/../views/' . $view . '.php';
    $layout = __DIR__ . '/../views/layout.php';
    if (!file_exists($viewFile)) { http_response_code(404); echo "Vista no encontrada"; exit; }
    include $layout;
}

function redirect(string $url) { header("Location: $url"); exit; }

function notFound() { http_response_code(404); echo "404 - No encontrado"; exit; }

// Routing básico
$controller = $_GET['controller'] ?? 'authors';
$action     = $_GET['action']     ?? 'index';

switch ($controller) {
    case 'authors':
        require_once __DIR__ . '/../src/Controllers/AuthorController.php';
        $c = new AuthorController();
        break;
    case 'books':
        require_once __DIR__ . '/../src/Controllers/BookController.php';
        $c = new BookController();
        break;
    default:
        notFound();
}

if (!method_exists($c, $action)) {
    notFound();
}

$c->$action();