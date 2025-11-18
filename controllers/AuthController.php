<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleLogin() {
        $error = '';

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            header('Location: ?route=monitor');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($this->userModel->authenticate($username, $password)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                header('Location: ?route=monitor');
                exit;
            } else {
                $error = 'Usuário ou senha inválidos.';
            }
        }
        
        require __DIR__ . '/../views/login.php';
    }

    public function handleLogout() {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        session_destroy();
        header('Location: ?route=login');
        exit;
    }
}
?>