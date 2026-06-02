<?php 
include 'includes/header.php'; 
// Генерируем CSRF-токен, если его нет
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="info-card">
                    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            Сообщение успешно отправлено. Спасибо!
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Произошла ошибка при отправке. Попробуйте позже.
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
                                <i class="bi bi-person-fill"></i> Ваше имя
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control form-control-lg"
                                   placeholder="Иванов Иван"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-envelope-fill"></i> Email
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control form-control-lg"
                                   placeholder="ivan@example.com"
                                   required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-chat-text-fill"></i> Сообщение
                            </label>
                            <textarea name="message"
                                      rows="6"
                                      class="form-control form-control-lg"
                                      placeholder="Введите ваше сообщение..."
                                      required></textarea>
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
