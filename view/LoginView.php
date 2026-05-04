<?php

class LoginView {

    function showLogin($error = null) {
        require_once __DIR__ . '/templates/Login.phtml';
    }
}
