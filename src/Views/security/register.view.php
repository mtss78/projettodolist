<?php
require_once(__DIR__ . "/../partials/head.php");
?>
<h1>Inscription</h1>
<form method='POST'>
    <div>
        <label for="pseudo">Pseudo</label>
        <input type="text" name='pseudo'>
        <?php if (isset($arrayError['pseudo'])) {
        ?>
            <p class='text-danger'><?= $arrayError['pseudo'] ?></p>
        <?php
        } ?>
    </div>
    <div>
        <label for="mail">Mail</label>
        <input type="email" name='mail'>
        <?php if (isset($arrayError['mail'])) {
        ?>
            <p class='text-danger'><?= $arrayError['mail'] ?></p>
        <?php
        } ?>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name='password'>
        <?php if (isset($arrayError['password'])) {
        ?>
            <p class='text-danger'><?= $arrayError['password'] ?></p>
        <?php
        } ?>
    </div>
    <div>
        <label for="idRole">Role</label>
        <select class="form-select" aria-label="idRole" name="idRole">
            <option value="1">Parent</option>
            <option value="2">Enfant</option>
        </select>
        <?php if (isset($arrayError['idRole'])) {
        ?>
            <p class='text-danger'><?= $arrayError['idRole'] ?></p>
        <?php
        } ?>
    </div>
    <button type="submit">Inscription</button>
</form>
<?php
if (isset($error)) {
    echo "<p class='text-danger'>" . $error . "<p>";
}
require_once(__DIR__ . "/../partials/footer.php");
?>