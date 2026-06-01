<?php include 'includes/header.php'; ?>
<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="hero-title">
                    Защищённый информационный портал МКУ «МЦСО»
                </h1>
                <p class="hero-text">
                    Современное решение для безопасного взаимодействия образовательных организаций,
                    хранения данных и информационной поддержки.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="form.php" class="btn btn-light hero-btn">
                        Подать обращение
                    </a>
                    <a href="documents.php" class="btn btn-outline-light hero-btn">
                        Методические материалы
                    </a>
                </div>
                <div class="hero-status mt-5">
                    <div class="status-item">
                        <span class="status-dot"></span>
                        HTTPS Active
                    </div>
                    <div class="status-item">
                        <span class="status-dot"></span>
                        Fail2Ban Enabled
                    </div>
                    <div class="status-item">
                        <span class="status-dot"></span>
                        Backup Running
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center mt-5 mt-lg-0">
                <i class="bi bi-shield-check"
                   style="font-size: 220px; opacity: 0.9;"></i>
            </div>
        </div>
    </div>
</section>
<!-- ABOUT -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">
            Основные направления деятельности
        </h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="info-card">
                    <i class="bi bi-mortarboard-fill"></i>
                    <h4>
                        Методическое сопровождение
                    </h4>
                    <p>
                        Организация методической поддержки образовательных учреждений
                        и педагогических работников.
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-card">
                    <i class="bi bi-diagram-3-fill"></i>
                    <h4>
                        Координация мероприятий
                    </h4>
                    <p>
                        Планирование, организация и информационная поддержка
                        образовательных мероприятий.
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-card">
                    <i class="bi bi-cloud-arrow-down-fill"></i>
                    <h4>
                        Централизованный доступ
                    </h4>
                    <p>
                        Безопасное хранение и предоставление доступа
                        к методическим материалам и документации.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SECURITY -->
<section class="security-section">
    <div class="container">
        <h2 class="section-title">
            Информационная безопасность
        </h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="security-item">
                    <i class="bi bi-lock-fill"></i>
                    <h5>HTTPS / SSL</h5>
                    <p>Шифрование соединения и защита передаваемых данных.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="security-item">
                    <i class="bi bi-shield-fill-check"></i>
                    <h5>Fail2Ban</h5>
                    <p>Защита от brute-force атак и подозрительных подключений.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="security-item">
                    <i class="bi bi-database-lock"></i>
                    <h5>MariaDB + PDO</h5>
                    <p>Безопасное взаимодействие с базой данных.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="security-item">
                    <i class="bi bi-hdd-stack-fill"></i>
                    <h5>Backup</h5>
                    <p>Автоматическое резервное копирование данных.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- NEWS -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">
            Новости и объявления
        </h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card news-card">
                    <img src="https://images.unsplash.com/photo-1468779036391-52341f60b55d"
                         class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            Обновление методических материалов
                        </h5>
                        <p class="card-text">
                            На портале размещены новые рекомендации для образовательных организаций.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card news-card">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87"
                         class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            Проведение окружного семинара
                        </h5>
                        <p class="card-text">
                            Состоялось методическое мероприятие для педагогических работников округа.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card news-card">
                    <img src="https://images.unsplash.com/photo-1614064641938-3bbee52942c7"
                         class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">
                            Усиление мер безопасности
                        </h5>
                        <p class="card-text">
                            Реализованы дополнительные механизмы защиты серверной инфраструктуры.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>