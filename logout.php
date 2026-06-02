<?php
// === Настройки безопасности ===
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
session_start();
// Функция для показа красивой ошибки
function showError($title, $message, $buttonText, $buttonLink) {
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Ошибка</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <style>
            body { background: linear-gradient(135deg, #f5f7fb 0%, #eef3ff 100%); min-height: 100vh; }
            .error-card { border-radius: 24px; border: none; box-shadow: 0 20px 35px -10px rgba(0,0,0,0.1); }
        </style>
    </head>
    <body>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card error-card">
                        <div class="card-body text-center p-5">
                            <?= $title ?>
                            <h3 class="mt-3 mb-3"><?= strip_tags($title) ?></h3>
                            <p class="text-muted mb-4"><?= htmlspecialchars($message) ?></p>
                            <a href="<?= htmlspecialchars($buttonLink) ?>" class="btn btn-primary px-4 py-2">
                                <?= htmlspecialchars($buttonText) ?>
                            </a>
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
// 1. Проверяем метод запроса (должен быть POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    showError(
        '<i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 48px;"></i>',
        'Для выхода из системы необходимо подтверждение.',
        'Перейти к подтверждению',
        'logout_confirm.php'
    );
}
// 2. Проверяем CSRF-токен
if (
    !isset($_POST['csrf_logout_token']) ||
    !isset($_SESSION['csrf_logout_token']) ||
    !hash_equals($_SESSION['csrf_logout_token'], $_POST['csrf_logout_token'])
) {
    showError(
        '<i class="bi bi-shield-exclamation text-danger" style="font-size: 48px;"></i>',
        'Недействительный токен безопасности. Возможно, сессия устарела.',
        'Попробовать снова',
        'logout_confirm.php'
    );
}
// 3. Очищаем сессию
$_SESSION = array();
// 4. Удаляем cookie сессии
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
// 5. Удаляем CSRF-токен из памяти (на всякий случай)
unset($_SESSION['csrf_logout_token']);
// 6. Разрушаем сессию
session_destroy();
// 7. Перенаправляем на страницу логина
header("Location: login.php?logout=1");
exit;
?>
