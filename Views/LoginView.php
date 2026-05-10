<?php

class LoginView {

    function showLogin($error = null) {
        require __DIR__ . '/templates/Login.phtml';
    }
}