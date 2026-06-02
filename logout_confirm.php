<?php
// === Настройки безопасности сессии ===
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
session_start();
// Проверяем, что пользователь вообще авторизован
if (!isset($_SESSION['user_id'])) {
    // Неавторизованным не нужна страница выхода
    header('Location: login.php');
    exit;
}
// Генерируем CSRF-токен для выхода
if (empty($_SESSION['csrf_logout_token'])) {
    $_SESSION['csrf_logout_token'] = bin2hex(random_bytes(32));
}
// Определяем, куда вернуться при отмене
$backUrl = 'dashboard.php';
if (isset($_SERVER['HTTP_REFERER']) && !strpos($_SERVER['HTTP_REFERER'], 'logout')) {
    $backUrl = $_SERVER['HTTP_REFERER'];
}
?>
<?php include 'includes/header.php'; ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="info-card text-center">
                    <div class="mb-4">
                        <i class="bi bi-box-arrow-right" style="font-size: 48px; color: #dc3545;"></i>
                    </div>
                    <h3 class="mb-3">Выход из системы</h3>
                    <p class="mb-4">
                        <?= htmlspecialchars($_SESSION['username']) ?>, вы действительно хотите выйти?
                    </p>
                    <form action="logout.php" method="POST">
                        <input type="hidden" 
                               name="csrf_logout_token" 
                               value="<?= htmlspecialchars($_SESSION['csrf_logout_token']) ?>">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger py-2">
                                <i class="bi bi-check-lg"></i> Да, выйти
                            </button>
                            <a href="<?= htmlspecialchars($backUrl) ?>" class="btn btn-outline-secondary py-2">
                                <i class="bi bi-x-lg"></i> Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
