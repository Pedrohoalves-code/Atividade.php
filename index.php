<?php
require 'Task.php';
require 'TaskManager.php';

$taskManager = new TaskManager('tasks.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['description'])) {
        $taskManager->addTask($_POST['description']);
    }
    if (isset($_POST['complete_id'])) {
        $taskManager->completeTask($_POST['complete_id']);
    }
}

$tasks = $taskManager->getTasks();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
</head>
<body>
    <h1>Lista de Tarefas</h1>
    <form method="POST">
        <input type="text" name="description" placeholder="Nova Tarefa" required>
        <button type="submit">Adicionar</button>
    </form>

    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?php echo $task->getDescription(); ?>
                <?php if (!$task->isCompleted()): ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="complete_id" value="<?php echo $task->getId(); ?>">
                        <button type="submit">Completar</button>
                    </form>
                <?php else: ?>
                    <span style="color: green;">(Completa)</span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
