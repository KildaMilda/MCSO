<?php
// === Настройки безопасности сессии ===
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
session_start();
require 'config/db.php';
$error = '';
$successMessage = '';
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $successMessage = 'Вы успешно вышли из системы.';
}
if (isset($_GET['timeout']) && $_GET['timeout'] == 1) {
    $error = 'Сессия истекла из-за неактивности. Войдите снова.';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['role']      = $user['role'];
        $_SESSION['login_time'] = time();
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Неверный логин или пароль";
    }
}
?>
<?php include 'includes/header.php'; ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="info-card">
                    <h2 class="mb-4 text-center">Авторизация</h2>
                    <?php if ($successMessage): ?>
                        <div class="alert alert-success text-center">
                            <?= htmlspecialchars($successMessage) ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($error): ?>
                        <div class="alert alert-danger text-center">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Логин</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Пароль</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-primary w-100 py-2">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
