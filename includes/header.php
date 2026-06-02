<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>МКУ «МЦСО»</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
</head>
<body>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container">
        <a class="navbar-brand" href="/index.php">
            <i class="bi bi-shield-lock-fill"></i>
            МКУ «МЦСО»
        </a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'index.php') ? 'active-nav' : '' ?>"
                       href="/index.php">
                        Главная
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'news.php') ? 'active-nav' : '' ?>"
                       href="/news.php">
                        Новости
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'documents.php') ? 'active-nav' : '' ?>"
                       href="/documents.php">
                        Документы
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'contacts.php') ? 'active-nav' : '' ?>"
                       href="/contacts.php">
                        Контакты
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0 d-flex align-items-center gap-3">
                        <span class="fw-semibold text-primary">
                            <i class="bi bi-person-circle"></i>
                            <?= htmlspecialchars($_SESSION['username']) ?>
                        </span>
                        <a class="btn btn-outline-danger px-4 py-2 rounded-3"
                           href="/logout_confirm.php">
                            Выйти
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-primary px-4 py-2 rounded-3"
                           href="/login.php">
                            Войти
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
