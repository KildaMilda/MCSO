<?php
require 'includes/auth.php';
?>
<?php include 'includes/header.php'; ?>
<section class="py-5">
    <div class="container">
        <div class="info-card">
            <div class="mb-4">
                <h2>Панель пользователя</h2>
                <p class="text-muted mb-0">Добро пожаловать, <?= htmlspecialchars($_SESSION['username']) ?></p>
            </div>
            <hr>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="bi bi-person-lock"></i>
                        <h4>
                            Авторизация
                        </h4>
                        <p>
                            Доступ к системе осуществляется через
                            защищённую сессию PHP.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="bi bi-shield-check"></i>
                        <h4>
                            Информационная безопасность
                        </h4>
                        <p>
                            Реализована защита от SQL-инъекций,
                            XSS и brute-force атак.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="bi bi-server"></i>
                        <h4>
                            Серверная инфраструктура
                        </h4>
                        <p>
                            Веб-приложение функционирует
                            на стеке LEMP.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
