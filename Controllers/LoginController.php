<?php
require_once __DIR__ . '/../Models/LoginModel.php';
require_once __DIR__ . '/../Views/LoginView.php';


class LoginController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new LoginModel();
        $this->view = new LoginView();
    }
    function showLogin() {
        $this->view->showLogin();
    }

    function verificar() {

        if (!empty($_POST['usuario']) && !empty($_POST['password'])) {

            $userName = $_POST['usuario'];
            $password = $_POST['password'];

            $user = $this->model->getUser($userName);

            if ($user && password_verify($password, $user->password)) {
                session_start();
                $_SESSION['usuario'] = $userName;
                $_SESSION['LAST_ACTIVITY'] = time();
                header('Location: ' . BASE_URL . 'listado');
                die();
            } else {
                $this->view->showLogin('Usuario o Password incorrectos');
                return;
            }
        }
        $this->view->showLogin('Completar los campos');
    }

    function logout() {
        session_start();
        session_destroy();
    
        header("Location: " . BASE_URL . "login");
        die();
    }

    
}
