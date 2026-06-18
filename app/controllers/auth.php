<?php
class auth {

    public $user = [
        "1" => "1",
        "user" => "654321"
    ];



public function login() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST["username"] ?? '';
        $password = $_POST["password"] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'Vui lòng nhập tên đăng nhập và mật khẩu';
            header("Location: /home/login");
            exit();
        }

        if (
            isset($this->user[$username]) &&
            $this->user[$username] === $password
        ) {
            // Đăng nhập thành công
            $_SESSION["username"] = $username;
            $_SESSION['success'] = 'Đăng nhập thành công';
            
            header("Location: /home/index");
            exit();
        } else {
            $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không chính xác';
            header("Location: /home/login");
            exit();
        }
    }
}
}
?>