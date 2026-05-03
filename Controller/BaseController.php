<?php

class BaseController {

    protected function checkLoggedIn() {
        session_start();

        if (!isset($_SESSION['USER_ID'])) {
            header('Location: ' . 'login');
            die();
        }
        if (isset($_SESSION['LAST_ACTIVITY'])) {
            if (time() - $_SESSION['LAST_ACTIVITY'] > 1800) {
                session_destroy();
                header('Location: ' . 'login');
                die();
            }
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }
}