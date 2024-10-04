<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Task;

class TaskController extends AbstractController
{
    public function createTask()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 1) {

            if (isset($_POST['title'])) {
                $this->check('title', $_POST['title']);
                $this->check('start_task', $_POST['start_task']);
                $this->check('stop_task', $_POST['stop_task']);
                $this->check('point', $_POST['point']);

                if (empty($this->arrayError)) {
                    $title = htmlspecialchars($_POST['title']);
                    $start_task = htmlspecialchars($_POST['start_task']);
                    $stop_task = htmlspecialchars($_POST['stop_task']);
                    $point = htmlspecialchars($_POST['point']);
                    $content = htmlspecialchars($_POST['content']);
                    $creation_date = date('Y-m-d H:i:s');
                    $id_user = $_SESSION['user']['idUser'];

                    $task = new Task(null, $title, $content, $creation_date, $start_task, $stop_task, $point, $id_user, null);

                    $task->addTask();
                    $this->redirectToRoute('/');
                }
            }

            require_once(__DIR__ . '/../Views/task/createTask.view.php');
        } else {
            $this->redirectToRoute('/');
        }
    }
}