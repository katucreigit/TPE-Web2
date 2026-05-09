<?php

class LoginView {

    function showLogin($error = null) {
        require_once DIR . '/templates/Login.phtml';
    }
}