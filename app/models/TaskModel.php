<?php

class TaskModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Obtener todas las tareas
    public function getAllTasks() {
        $sql = "SELECT * FROM tasks";
        return $this->db->fetchAll($sql); 
    }

    // Obtener una tarea por ID 
    public function getTaskById($id) {
        $sql = "SELECT * FROM tasks WHERE id = ?";
        return $this->db->fetch($sql, [$id]);
    }

    // Crear una nueva tarea 
    public function createTask($title, $description) {
        $sql = "INSERT INTO tasks (title, description) VALUES (?, ?)";
        return $this->db->execute($sql, [$title, $description]);
    }

    // Actualizar una tarea existente 
    public function updateTask($id, $title, $description) {
        $sql = "UPDATE tasks SET title = ?, description = ? WHERE id = ?";
        return $this->db->execute($sql, [$title, $description, $id]);
    }

    // Eliminar una tarea por ID 
    public function deleteTask($id) {
        $sql = "DELETE FROM tasks WHERE id = ?";
        return $this->db->execute($sql, [$id]);
    }
}
