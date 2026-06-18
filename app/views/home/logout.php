<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['success'] = 'Đăng xuất thành công';
session_destroy();

if(isset($_COOKIE['username'])) {
    setcookie('username', '', time() - 3600);
}

header('Location: /home/login');
exit();
?>