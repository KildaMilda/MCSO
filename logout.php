<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
session_start();
// Проверяем метод
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}
// Проверяем CSRF
if (
    !isset($_POST['csrf_logout_token']) ||
    !isset($_SESSION['csrf_logout_token']) ||
    !hash_equals($_SESSION['csrf_logout_token'], $_POST['csrf_logout_token'])
) {
    http_response_code(403);
    die('Недействительный запрос выхода');
}
// Очищаем сессию
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
header('Location: login.php?logout=1');
exit;
?>
