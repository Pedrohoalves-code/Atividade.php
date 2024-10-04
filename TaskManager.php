<?php
// Define a classe TaskManager, responsável pela gestão de tarefas
class TaskManager {
    // Propriedades privadas: um array para armazenar as tarefas e o caminho do arquivo
    private $tasks = [];
    private $filePath;

    // Construtor da classe, que recebe o caminho do arquivo como parâmetro
    public function __construct($filePath) {
        $this->filePath = $filePath; // Define o caminho do arquivo
        $this->loadTasks(); // Carrega as tarefas do arquivo
    }

    // Método privado para carregar tarefas do arquivo JSON
    private function loadTasks() {
        // Verifica se o arquivo existe
        if (file_exists($this->filePath)) {
            // Lê o conteúdo do arquivo e decodifica o JSON em um array
            $data = json_decode(file_get_contents($this->filePath), true);
            // Itera sobre os dados e cria objetos Task a partir deles
            foreach ($data as $taskData) {
                $this->tasks[] = new Task($taskData['id'], $taskData['description'], $taskData['completed']);
            }
        }
    }

    // Método público para adicionar uma nova tarefa
    public function addTask($description) {
        // Gera um novo ID com base na quantidade de tarefas já existentes
        $id = count($this->tasks) + 1;
        // Cria uma nova tarefa
        $task = new Task($id, $description);
        // Adiciona a nova tarefa ao array de tarefas
        $this->tasks[] = $task;
        // Salva as tarefas atualizadas no arquivo
        $this->saveTasks();
    }

    // Método público para marcar uma tarefa como completa
    public function completeTask($id) {
        // Itera sobre as tarefas para encontrar a tarefa com o ID correspondente
        foreach ($this->tasks as $task) {
            if ($task->getId() == $id) {
                $task->markAsCompleted(); // Marca a tarefa como completa
                break; // Sai do loop após encontrar a tarefa
            }
        }
        // Salva as tarefas atualizadas no arquivo
        $this->saveTasks();
    }

    // Método privado para salvar as tarefas no arquivo
    private function saveTasks() {
        // Mapeia as tarefas para um array associativo para exportação
        $data = array_map(function($task) {
            return $task->toArray(); // Converte cada tarefa em um array
        }, $this->tasks);
        // Codifica o array como JSON e grava no arquivo
        file_put_contents($this->filePath, json_encode($data));
    }

    // Método público para obter todas as tarefas
    public function getTasks() {
        return $this->tasks; // Retorna o array de tarefas
    }
}
?>
