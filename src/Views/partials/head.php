<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La sueur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="/public/img/logo.png" class="logo" alt="Logo le Poles" width="30" height="30" class="d-inline-block align-text-top">
            </a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end fw-semibold" id="navbarNav">
                <ul class="navbar-nav">
                <?php
            if(isset($_SESSION['user'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/logout"><i class="fa-solid fa-circle-plus"></i> Deconnexion</a>
                </li>
                <?php
                if($_SESSION['user']['role']== "Admin"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/users"><i class="fa-solid fa-circle-plus"></i> Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/subject"><i class="fa-solid fa-circle-plus"></i> Ajout sujet</a>
                    </li>
                    <?php
                }
            } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/register"><i class="fa-solid fa-circle-plus"></i> Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/connection"><i class="fa-solid fa-circle-plus"></i> Connexion</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</nav>
<div class="myBody">