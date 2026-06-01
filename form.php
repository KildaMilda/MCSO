<?php include 'includes/header.php'; ?>
<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="info-card">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        Сообщение успешно отправлено.
                    </div>
                <?php endif; ?>
                    <h2 class="mb-4 text-center">
                        Обратная связь
                    </h2>
                    <p class="text-center text-muted mb-5">
                        Отправьте сообщение администрации портала
                    </p>
                    <form action="save.php" method="POST">
                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
                        >
                        <div class="mb-3">
                            <label class="form-label">
                                Ваше имя
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                Email
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">
                                Сообщение
                            </label>
                            <textarea name="message"
                                      rows="6"
                                      class="form-control"
                                      required></textarea>
                        </div>
                        <button class="btn btn-primary w-100 py-3">
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
