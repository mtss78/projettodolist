<?php
require_once(__DIR__ . "/../partials/head.php");
?>
<h1>Inscription</h1>
<form method='POST'>
    <div>
        <label for="pseudo">Pseudo</label>
        <input type="text" name='pseudo'>
        <?php if (isset($this->arrayError['pseudo'])) {
        ?>
            <p class='text-danger'><?= $this->arrayError['pseudo'] ?></p>
        <?php
        } ?>
    </div>
    <div>
        <label for="mail">Mail</label>
        <input type="email" name='mail'>
        <?php if (isset($this->arrayError['mail'])) {
        ?>
            <p class='text-danger'><?= $this->arrayError['mail'] ?></p>
        <?php
        } ?>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name='password'>
        <?php if (isset($this->arrayError['password'])) {
        ?>
            <p class='text-danger'><?= $this->arrayError['password'] ?></p>
        <?php
        } ?>
    </div>
    <div>
        <label for="idRole">Role</label>
        <select class="form-select" aria-label="idRole" name="idRole">
            <option value="1">Parent</option>
            <option value="2">Enfant</option>
        </select>
        <?php if (isset($this->arrayError['idRole'])) {
        ?>
            <p class='text-danger'><?= $this->arrayError['idRole'] ?></p>
        <?php
        } ?>
    </div>
    <button type="submit">Inscription</button>
</form>
<?php
require_once(__DIR__ . "/../partials/footer.php");
?>