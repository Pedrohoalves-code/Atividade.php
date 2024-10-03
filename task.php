<?php
class Task {
    private $id;
    private $description;
    private $completed;

    public function __construct($id, $description, $completed = false) {
        $this->id = $id;
        $this->description = $description;
        $this->completed = $completed;
    }

    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function isCompleted() {
        return $this->completed;
    }

    public function markAsCompleted() {
        $this->completed = true;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'completed' => $this->completed,
        ];
    }
}

?>