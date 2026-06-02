<?php
// === Настройки безопасности сессии ===
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
session_start();
// Проверка авторизации
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
// Проверка времени неактивности (15 минут)
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > 900)) {
    session_destroy();
    header('Location: login.php?timeout=1');
    exit;
}
// Обновляем время последней активности
$_SESSION['login_time'] = time();
?>
