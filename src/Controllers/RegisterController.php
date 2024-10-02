<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    public function index()
    {

        if (isset($_POST['pseudo'], $_POST['mail'], $_POST['password'], $_POST['idRole'])) {
            $this->check('pseudo', $_POST['pseudo']);
            $this->check('mail', $_POST['mail']);
            $this->check('password', $_POST['password']);
            $this->check('idRole', $_POST['idRole']);

            if (empty($this->arrayError)) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $mail = htmlspecialchars($_POST['mail']);
                $password = htmlspecialchars($_POST['password']);
                $id_role = htmlspecialchars($_POST['idRole']);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $user = new User(null, $pseudo, $mail, $passwordHash, null, $id_role);
                $user->save();
                $this->redirectToRoute('/');
            }
        }
        require_once(__DIR__ . "/../Views/security/register.view.php");
    }
}