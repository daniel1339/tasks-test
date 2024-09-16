<?php
require_once '../helpers/Validation.php';


class TaskController {
    private $taskModel;

    public function __construct($db) {
        $this->taskModel = new TaskModel($db);

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

   
    public function index() {
        $tasks = $this->taskModel->getAllTasks();
        include '../app/views/tasks/index.php';
    }

   
    public function create() {
        include '../app/views/tasks/create.php';
    }

    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $_SESSION['errors'] = ['csrf' => 'Token CSRF inválido.'];
                header('Location: /create');
                exit;
            }

           
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');

            // Validar los datos
            $errors = [];
            if (!Validation::required($title)) {
                $errors['title'] = 'Título es requerido.';
            }
            if (!Validation::required($description)) {
                $errors['description'] = 'Descripción es requerida.';
            }

            // Si hay errores, volver a mostrar el formulario con mensajes de error
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['form_data'] = $_POST; 
                header('Location: /create');
                exit;
            }

          
            $this->taskModel->createTask($title, $description);

            
            header('Location: /');
            exit;
        }
    }

    
    public function edit($id) {
        $task = $this->taskModel->getTaskById($id);
        if ($task) {
            include '../app/views/tasks/edit.php';
        } else {
            echo "Tarea no encontrada.";
        }
    }

    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
                
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    $_SESSION['errors'] = ['csrf' => 'Token CSRF inválido.'];
                    header('Location: /edit?id=' . urlencode($id));
                    exit;
                }

               
                $title = trim($_POST['title'] ?? '');
                $description = trim($_POST['description'] ?? '');

               
                $errors = [];
                if (!Validation::required($title)) {
                    $errors['title'] = 'Título es requerido.';
                }
                if (!Validation::required($description)) {
                    $errors['description'] = 'Descripción es requerida.';
                }

               
                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['form_data'] = $_POST; 
                    header('Location: /edit?id=' . urlencode($id));
                    exit;
                }

                
                $this->taskModel->updateTask($id, $title, $description);

                
                header('Location: /');
                exit;
            }
        }
    }

   
    public function delete($id) {
        $this->taskModel->deleteTask($id);
        header('Location: /');
        exit;
    }
}
