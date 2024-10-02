<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class LoginController extends AbstractController
{
    public function index()
    {
        if (isset($_POST['mail'], $_POST['password'])) {
            $this->check('mail', $_POST['mail']);
            $this->check('password', $_POST['password']);

            if (empty($this->arrayError)) {
                $mail = htmlspecialchars($_POST['mail']);
                $password = htmlspecialchars($_POST['password']);

                $user = new User(null, null, $mail, $password, null, null);
                $responseGetUser = $user->login($mail);


                if ($responseGetUser) {
                    $passwordUser = $responseGetUser->getPassword();

                    if (password_verify($password, $passwordUser)) {
                        $_SESSION['user'] = [
                            'id' => uniqid(),
                            'mail' => $responseGetUser->getMail(),
                            'pseudo' => $responseGetUser->getPseudo(),
                            'idUser' => $responseGetUser->getId(),
                            'score' => $responseGetUser->getScore(),
                            'idRole' => $responseGetUser->getId_role()
                        ];
                        $this->redirectToRoute('/');
                    } else {
                        $error = "Le mail ou mot de passe n'est pas correct";
                    }
                } else {
                    $error = "Le mail ou mot de passe n'est pas correct";
                }
            }
        }
        if (isset($_SESSION['user'])) {
            $this->redirectToRoute('/');
        }
        require_once(__DIR__ . "/../Views/security/login.view.php");
    }
}