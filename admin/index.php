<?php require '../includes/admin_auth.php';?>
<?php include '../includes/header.php'; ?>
<?php $currentAdminPage = basename($_SERVER['PHP_SELF']); ?>
<div class="admin-layout">
    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div>
            <div class="admin-logo">
                <i class="bi bi-shield-lock-fill"></i>
                <span>
                    ADMIN PANEL
                </span>
            </div>
            <nav class="admin-nav">
                <a href="/admin/index.php"
                   class="admin-link <?= $currentAdminPage == 'index.php' ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Dashboard
                </a>
                <a href="/admin/messages.php"
                   class="admin-link <?= $currentAdminPage == 'index.php' ? 'active' : '' ?>">
                    <i class="bi bi-envelope-fill"></i>
                    Сообщения
                </a>
                <!--
                <a href="#"
                   class="admin-link">
                    <i class="bi bi-people-fill"></i>
                    Пользователи
                </a>
                <a href="#"
                   class="admin-link">
                    <i class="bi bi-shield-check"></i>
                    Безопасность
                </a>
                <a href="#"
                   class="admin-link">
                    <i class="bi bi-database-fill"></i>
                    Резервные копии
                </a>
                -->
            </nav>
        </div>
        <div class="admin-system-status">
            <h6 class="mb-3">
                Состояние системы
            </h6>
            <div class="status-line">
                <span class="status-dot"></span>
                HTTPS Active
            </div>
            <div class="status-line">
                <span class="status-dot"></span>
                MariaDB Online
            </div>
            <div class="status-line">
                <span class="status-dot"></span>
                Fail2Ban Active
            </div>
        </div>
    </aside>
    <!-- CONTENT -->
    <main class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold">
                    Панель администратора
                </h1>
                <p class="text-muted mb-0">
                    Централизованное управление системой
                </p>
            </div>
            <div class="admin-profile">
                <i class="bi bi-person-circle"></i>
                <?= htmlspecialchars($_SESSION['username']) ?>
            </div>
        </div>
        <!-- STATS -->
        <div class="row g-4 mb-5">
            <?php
            // Получаем реальное количество сообщений
            $stmtCount = $pdo->query("SELECT COUNT(*) FROM messages");
            $totalMessages = $stmtCount->fetchColumn();
            // Получаем общее количество сообщений
            ?>
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                <div>
                    <h3><?= $totalMessages ?></h3>
                    <p>Всего сообщений</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h3>
                            Secure
                        </h3>
                        <p>
                            Статус системы
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <div class="dashboard-icon">
                        <i class="bi bi-server"></i>
                    </div>
                    <div>
                        <h3>
                            Debian
                        </h3>
                        <p>
                            Серверная платформа
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- MAIN CARDS -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="admin-widget">
                    <div class="d-flex justify-content-between mb-4">
                        <h4>
                            Обращения пользователей
                        </h4>
                        <span class="badge bg-primary">
                            NEW
                        </span>
                    </div>
                    <p class="text-muted">
                        Просмотр и обработка сообщений,
                        отправленных через форму обратной связи.
                    </p>
                    <a href="/admin/messages.php"
                       class="btn btn-primary rounded-3">
                        Открыть раздел
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="admin-widget">
                    <div class="d-flex justify-content-between mb-4">
                        <h4>
                            Мониторинг безопасности
                        </h4>
                        <span class="badge bg-success">
                            ACTIVE
                        </span>
                    </div>
                    <p class="text-muted">
                        Контроль состояния системы,
                        механизмов защиты и резервного копирования.
                    </p>
                    <button class="btn btn-outline-primary rounded-3">
                        Подробнее
                    </button>
                </div>
            </div>
        </div>
        <!-- SYSTEM LOGS -->
        <div class="admin-widget mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>
                    Системные журналы
                </h4>
                <span class="badge bg-success">
                    LIVE
                </span>
            </div>
            <div class="system-logs">
                <div class="log-item success">
                    <span>[OK]</span>
                    HTTPS certificate validated
                </div>
                <div class="log-item info">
                    <span>[INFO]</span>
                    MariaDB backup completed successfully
                </div>
                <div class="log-item warning">
                    <span>[SECURITY]</span>
                    Failed login attempt blocked
                </div>
                <div class="log-item success">
                    <span>[OK]</span>
                    Firewall rules synchronized
                </div>
                <div class="log-item info">
                    <span>[INFO]</span>
                    Nginx configuration reloaded
                </div>
            </div>
        </div>
    </main>
</div>
