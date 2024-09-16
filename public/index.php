<?php
session_start();
header('Cache-Control: no-cache, no-store, must-revalidate'); 
header('Pragma: no-cache');
header('Expires: 0'); 

require_once __DIR__ . '/../vendor/autoload.php';
require '../app/core/Database.php';
require '../app/models/TaskModel.php';
require '../app/controllers/TaskController.php';

// Cargar configuración
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Inicializar base de datos
$db = new Database();
$taskController = new TaskController($db);

// Enrutamiento básico
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch ($request) {
    case '/':
        $taskController->index();
        break;
    case '/create':
        $taskController->create();
        break;
    case '/store':
        $taskController->store();
        break;
    case '/edit':
        if (isset($_GET['id'])) {
            $taskController->edit($_GET['id']);
        }
        break;
    case '/update':
        if (isset($_GET['id'])) {
            $taskController->update($_GET['id']);
        }
        break;
    case '/delete':
        if (isset($_GET['id'])) {
            $taskController->delete($_GET['id']);
        }
        break;
    default:
        http_response_code(404);
        echo "Página no encontrada.";
        break;
}

