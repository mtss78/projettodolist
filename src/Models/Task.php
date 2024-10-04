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
    protected ?string $pseudo;

    public function __construct(?int $id, ?string $title, ?string $content, ?string $creation_date, ?string $start_task, ?string $stop_task, ?int $point, ?int $id_user, ?string $pseudo)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->creation_date = $creation_date;
        $this->start_task = $start_task;
        $this->stop_task = $stop_task;
        $this->point = $point;
        $this->id_user = $id_user;
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
            $task = new Task($row['id'], $row['title'], null, null, $row['start_task'], $row['stop_task'], null, null, null);
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
            $task = new Task($row['id'], $row['title'], null, null, $row['start_task'], $row['stop_task'], null, null, $row['pseudo']);
            $tasks[] = $task;
        }
        return $tasks;
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

    public function setPseudo(?string $pseudo): static
    {
        $this->pseudo = $pseudo;
        return $this;
    }
}