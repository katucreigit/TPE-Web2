<?php

class ErrorView {
    protected $user;

    public function setUser($user) {
        $this->user = $user;
    }
    public function render($err = null) {
        require __DIR__ . '/templates/error.phtml';
    }
}