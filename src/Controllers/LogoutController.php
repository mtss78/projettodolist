<?php

namespace App\Controllers;

use App\Utils\AbstractController;

class LogoutController extends AbstractController
{
    public function logout()
    {
        session_destroy();
        $this->redirectToRoute('/');
    }
}