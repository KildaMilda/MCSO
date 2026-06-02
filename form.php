<?php 
include 'includes/header.php'; 
// Генерируем CSRF-токен, если его нет
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
// Восстанавливаем старые данные из сессии (если были ошибки)
$oldName = '';
$oldEmail = '';
$oldMessage = '';
if (isset($_GET['error']) && isset($_SESSION['old_input'])) {
    $oldName = htmlspecialchars($_SESSION['old_input']['name'] ?? '');
    $oldEmail = htmlspecialchars($_SESSION['old_input']['email'] ?? '');
    $oldMessage = htmlspecialchars($_SESSION['old_input']['message'] ?? '');
    unset($_SESSION['old_input']);
}
?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="info-card">
                    <!-- УСПЕХ -->
                    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            Сообщение успешно отправлено. Спасибо!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <!-- ОШИБКА -->
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <?= htmlspecialchars(urldecode($_GET['error'])) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <h2 class="mb-4 text-center">
                        <i class="bi bi-chat-dots-fill"></i>
                        Обратная связь
                    </h2>
                    <p class="text-center text-muted mb-5">
                        Отправьте сообщение администрации портала
                    </p>
                    <form action="save.php" method="POST">
                        <input type="hidden"
                               name="csrf_token"
                               value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-person-fill"></i> Ваше имя <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control form-control-lg"
                                   placeholder="Иванов Иван"
                                   value="<?= $oldName ?>"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-envelope-fill"></i> Email <span class="text-danger">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control form-control-lg"
                                   placeholder="ivan@example.com"
                                   value="<?= $oldEmail ?>"
                                   required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-chat-text-fill"></i> Сообщение <span class="text-danger">*</span>
                            </label>
                            <textarea name="message"
                                      rows="6"
                                      class="form-control form-control-lg"
                                      placeholder="Введите ваше сообщение..."
                                      required><?= $oldMessage ?></textarea>
                            <div class="form-text text-muted mt-2">
                                Максимальная длина сообщения — 5000 символов
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold">
                            <i class="bi bi-send-fill"></i>
                            Отправить сообщение
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
