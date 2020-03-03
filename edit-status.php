<?php 
require_once "TaskBoard.php";
$taskBoard = new TaskBoard();

$status_id = $_GET["status_id"];
$task_id = $_GET["task_id"];

$result = $taskBoard->editTaskStatus($status_id, $task_id);
?>