<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Task;

class HomeController extends AbstractController
{
    public function index()
    {
        if (isset($_SESSION['user'])) {

            $task = new Task(null, null, null, null, null, null, null, null, null, null);
            $arrayTasks = $task->unassignedFutureTask();

            if ($_SESSION['user']['idRole'] == 1) {
                $arrayTasksByUsers = $task->assignedFutureTask();
            }
        }
        require_once(__DIR__ . '/../Views/home.view.php');
    }
}