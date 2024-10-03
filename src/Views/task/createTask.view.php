<?php
require_once(__DIR__ . '/../partials/head.php');
?>
<h1>Création d'une tâche</h1>
<form method='POST'>
    <div class="col-md-4 mx-auto d-block mt-5">
        <div class="mb-3">
            <label for="title">Nom de la tâche</label>
            <input type="text" name='title'>
            <?php if (isset($this->arrayError['title'])) {
            ?>
                <p class='text-danger'><?= $this->arrayError['title'] ?></p>
            <?php
            } ?>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Détails</label>
            <textarea class="form-control" name="content"></textarea>
            <?php if (isset($arrayError['content'])) {
            ?>
                <p class='text-danger'><?= $arrayError['content'] ?></p>
            <?php
            } ?>
        </div>
        <div class="mb-3">
            <label for="start_task">Date du début</label>
            <input type="datetime-local" name='start_task' value="<?= date("Y-m-d H:i") ?>">
            <?php if (isset($this->arrayError['start_task'])) {
            ?>
                <p class='text-danger'><?= $this->arrayError['start_task'] ?></p>
            <?php
            } ?>
        </div>
        <div class="mb-3">
            <label for="stop_task">Date limite de fin</label>
            <input type="datetime-local" name='stop_task'>
            <?php if (isset($this->arrayError['stop_task'])) {
            ?>
                <p class='text-danger'><?= $this->arrayError['stop_task'] ?></p>
            <?php
            } ?>
        </div>
        <div class="mb-3">
            <label for="point">Points</label>
            <input type="number" name='point'>
            <?php if (isset($this->arrayError['point'])) {
            ?>
                <p class='text-danger'><?= $this->arrayError['point'] ?></p>
            <?php
            } ?>
        </div>
        <button type="submit" class='btn btn-success mt-5 mb-5'>Création tâche</button>
    </div>
</form>

<?php
require_once(__DIR__ . '/../partials/footer.php');
?>