<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
// Дополнительная проверка времени сессии (15 минут неактивности = выход)
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > 900)) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
