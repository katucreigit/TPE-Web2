<?php

class BaseController {

    protected function checkLoggedIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }

        if (isset($_SESSION['LAST_ACTIVITY'])) {
            if (time() - $_SESSION['LAST_ACTIVITY'] > 1800) {
                session_destroy();
                header('Location: ' . BASE_URL . 'login');
                die();
            }
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }
}