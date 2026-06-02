<?php
// === Настройки безопасности сессии ===
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
session_start();
// Полная очистка сессии
$_SESSION = array();                    // Очищаем все переменные сессии
// Уничтожаем сессию на сервере
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/'); // Удаляем куку
}
session_destroy();
// Перенаправление на страницу входа
header("Location: login.php?logout=1");
exit;
?>
