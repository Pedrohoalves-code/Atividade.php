<?php
// Define a classe Task, representando uma tarefa individual
class Task {
    // Propriedades privadas: ID, descrição e status de conclusão da tarefa
    private $id;
    private $description;
    private $completed;

    // Construtor da classe, que recebe ID, descrição e um status de conclusão opcional
    public function __construct($id, $description, $completed = false) {
        $this->id = $id; // Define o ID da tarefa
        $this->description = $description; // Define a descrição da tarefa
        $this->completed = $completed; // Define o status de conclusão (padrão é false)
    }

    // Método público para obter o ID da tarefa
    public function getId() {
        return $this->id; // Retorna o ID da tarefa
    }

    // Método público para obter a descrição da tarefa
    public function getDescription() {
        return $this->description; // Retorna a descrição da tarefa
    }

    // Método público para verificar se a tarefa está completa
    public function isCompleted() {
        return $this->completed; // Retorna o status de conclusão da tarefa
    }

    // Método público para marcar a tarefa como completa
    public function markAsCompleted() {
        $this->completed = true; // Define o status de conclusão como true
    }

    // Método público para converter a tarefa em um array associativo
    public function toArray() {
        return [
            'id' => $this->id, // Inclui o ID
            'description' => $this->description, // Inclui a descrição
            'completed' => $this->completed, // Inclui o status de conclusão
        ];
    }
}
?>
