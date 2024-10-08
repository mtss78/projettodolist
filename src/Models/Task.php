<?php

namespace App\Models;

use Config\DataBase;
use PDO;

class Task
{
    protected ?int $id;
    protected ?string $title;
    protected ?string $content;
    protected ?string $creation_date;
    protected ?string $start_task;
    protected ?string $stop_task;
    protected ?int $point;
    protected ?int $id_user;
    protected ?string $status;
    protected ?string $pseudo;


    public function __construct(?int $id, ?string $title, ?string $content, ?string $creation_date, ?string $start_task, ?string $stop_task, ?int $point, ?int $id_user, ?string $status, ?string $pseudo)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->creation_date = $creation_date;
        $this->start_task = $start_task;
        $this->stop_task = $stop_task;
        $this->point = $point;
        $this->id_user = $id_user;
        $this->status = $status;
        $this->pseudo = $pseudo;
    }

    public function addTask(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO `task` (`id`, `title`, `content`, `creation_date`, `start_task`, `stop_task`, `point`, `id_user`) VALUES (?,?,?,?,?,?,?,?)";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id, $this->title, $this->content, $this->creation_date, $this->start_task, $this->stop_task, $this->point, $this->id_user]);
    }

    public function unassignedFutureTask(): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT `task`.`id`, `task`.`title`, `task`.`start_task`, `task`.`stop_task`
            FROM `todo`
            RIGHT JOIN `task` ON `todo`.`id_task` = `task`.`id`
            WHERE `task`.`stop_task` >= CURDATE() 
            AND `todo`.`id_user` IS NULL 
            ORDER BY `task`.`start_task` ASC";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $resultFetch = $statement->fetchAll(PDO::FETCH_ASSOC);
        $tasks = [];
        foreach ($resultFetch as $row) {
            $task = new Task($row['id'], $row['title'], null, null, $row['start_task'], $row['stop_task'], null, null, null, null);
            $tasks[] = $task;
        }
        return $tasks;
    }

    public function assignedFutureTask()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT `task`.`id`, `task`.`title`, `task`.`start_task`, `task`.`stop_task`, `user`.`pseudo`
            FROM `todo`
            RIGHT JOIN `task` ON `todo`.`id_task` = `task`.`id`
            LEFT JOIN `user` ON `todo`.`id_user` = `user`.`id`
            WHERE `task`.`stop_task` >= CURDATE() 
            AND `todo`.`id_user` IS NOT NULL 
            ORDER BY `task`.`start_task` ASC";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $resultFetch = $statement->fetchAll(PDO::FETCH_ASSOC);
        $tasks = [];
        foreach ($resultFetch as $row) {
            $task = new Task($row['id'], $row['title'], null, null, $row['start_task'], $row['stop_task'], null, null, null, $row['pseudo']);
            $tasks[] = $task;
        }
        return $tasks;
    }

    public function getTaskById()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT `task`.`id`, `task`.`title`, `task`.`content`, `task`.`creation_date`, `task`.`start_task`, `task`.`stop_task`, `task`.`point`, `task`.`id_user`, `todo`.`status`, `user`.`pseudo` FROM `task` LEFT JOIN `todo` ON `task`.`id` = `todo`.`id_task` LEFT JOIN `user` ON `todo`.`id_user` = `user`.`id` WHERE `task`.`id` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Task($row['id'], $row['title'], $row['content'], $row['creation_date'], $row['start_task'], $row['stop_task'], $row['point'], $row['id_user'], $row['status'], $row['pseudo']);
        } else {
            return null;
        }
    }

    public function updateTask()
    {
        $pdo = DataBase::getConnection();
        $sql = "UPDATE `task` 
        SET `title` = ?, `content` = ?, `start_task` = ?, `stop_task` = ?, `point` = ?
        WHERE `task`.`id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->title, $this->content, $this->start_task, $this->stop_task, $this->point, $this->id]);
    }

    public function deleteTask()
    {
        $pdo = DataBase::getConnection();
        $sql = 'DELETE FROM `task` WHERE `id` = ?';
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }

    public function deleteTodo()
    {
        $pdo = DataBase::getConnection();
        $sql = "DELETE FROM `todo` WHERE `id_task` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getCreationDate(): ?string
    {
        return $this->creation_date;
    }
    public function getStartTask(): string
    {
        return $this->start_task;
    }
    public function getStopTask(): ?string
    {
        return $this->stop_task;
    }

    public function getPoint(): ?int
    {
        return $this->point;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function setCreationDate(?string $creation_date): static
    {
        $this->creation_date = $creation_date;
        return $this;
    }

    public function setStartTask(?string $start_task): static
    {
        $this->start_task = $start_task;
        return $this;
    }

    public function setStopTask(?string $stop_task): static
    {
        $this->stop_task = $stop_task;
        return $this;
    }

    public function setPoint(?int $point): static
    {
        $this->point = $point;
        return $this;
    }

    public function setIdUser(?int $id_user): static
    {
        $this->id_user = $id_user;
        return $this;
    }

    public function setStatus(?string $status)
    {
        $this->status = $status;
        return $this;
    }

    public function setPseudo(?string $pseudo): static
    {
        $this->pseudo = $pseudo;
        return $this;
    }
}