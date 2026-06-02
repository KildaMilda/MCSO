<?php
// logout.php
// === Настройки безопасности ===
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
session_start();
// Если это GET-запрос — показываем понятную ошибку
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Ошибка выхода</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body text-center p-5">
                            <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 48px;"></i>
                            <h3 class="mt-3">Некорректный запрос</h3>
                            <p class="text-muted">Для выхода из системы используйте кнопку на странице подтверждения.</p>
                            <a href="logout_confirm.php" class="btn btn-primary">Перейти к выходу</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}
// Проверка CSRF
if (
    !isset($_POST['csrf_logout_token']) ||
    !isset($_SESSION['csrf_logout_token']) ||
    !hash_equals($_SESSION['csrf_logout_token'], $_POST['csrf_logout_token'])
) {
    http_response_code(403);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Ошибка безопасности</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body text-center p-5">
                            <i class="bi bi-shield-exclamation text-danger" style="font-size: 48px;"></i>
                            <h3 class="mt-3">Ошибка валидации</h3>
                            <p class="text-muted">Недействительный токен безопасности. Попробуйте ещё раз.</p>
                            <a href="logout_confirm.php" class="btn btn-primary">Попробовать снова</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}
// Полная очистка сессии
$_SESSION = array();
// Удаляем cookie сессии
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
// Удаляем CSRF-токен (необязательно, но аккуратно)
unset($_SESSION['csrf_logout_token']);
// Разрушаем сессию
session_destroy();
// Перенаправляем на страницу логина с сообщением
header("Location: login.php?logout=1");
exit;
?>
