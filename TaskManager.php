<?php
class TaskManager {
    private $tasks = [];
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
        $this->loadTasks();
    }

    private function loadTasks() {
        if (file_exists($this->filePath)) {
            $data = json_decode(file_get_contents($this->filePath), true);
            foreach ($data as $taskData) {
                $this->tasks[] = new Task($taskData['id'], $taskData['description'], $taskData['completed']);
            }
        }
    }

    public function addTask($description) {
        $id = count($this->tasks) + 1;
        $task = new Task($id, $description);
        $this->tasks[] = $task;
        $this->saveTasks();
    }

    public function completeTask($id) {
        foreach ($this->tasks as $task) {
            if ($task->getId() == $id) {
                $task->markAsCompleted();
                break;
            }
        }
        $this->saveTasks();
    }

    private function saveTasks() {
        $data = array_map(function($task) {
            return $task->toArray();
        }, $this->tasks);
        file_put_contents($this->filePath, json_encode($data));
    }

    public function getTasks() {
        return $this->tasks;
    }
}
?>