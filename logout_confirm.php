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
    // Если не авторизован, зачем ему страница выхода?
    header('Location: login.php');
    exit;
}
// Генерируем CSRF-токен для выхода
if (empty($_SESSION['csrf_logout_token'])) {
    $_SESSION['csrf_logout_token'] = bin2hex(random_bytes(32));
}
?>
<?php include 'includes/header.php'; ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="info-card text-center">
                    <h3 class="mb-4">Выход из системы</h3>
                    <p class="mb-4">
                        Вы действительно хотите выйти из аккаунта?
                        <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>?
                    </p>
                    <form action="logout.php" method="POST">
                        <input type="hidden" 
                               name="csrf_logout_token" 
                               value="<?= htmlspecialchars($_SESSION['csrf_logout_token']) ?>">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger py-2">
                                <i class="bi bi-box-arrow-right"></i> Да, выйти
                            </button>
                            <?php
                            // Возвращаем пользователя туда, откуда он пришёл
                            $referer = $_SERVER['HTTP_REFERER'] ?? 'dashboard.php';
                            // Но не пускаем на страницу выхода
                            if (strpos($referer, 'logout') !== false) {
                                $referer = 'dashboard.php';
                            }
                            ?>
                            <a href="<?= htmlspecialchars($referer) ?>" class="btn btn-secondary py-2">
                                Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?
