<?php
require '../includes/admin_auth.php';
require '../config/db.php';
// Поиск
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if (!empty($search)) {
    $stmt = $pdo->prepare("
        SELECT * FROM messages 
        WHERE name LIKE ? OR email LIKE ? OR message LIKE ? 
        ORDER BY created_at DESC
    ");
    $stmt->execute(["%$search%", "%$search%", "%$search%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
}
$messages = $stmt->fetchAll();
// Подсветка активного пункта меню
$currentAdminPage = basename($_SERVER['PHP_SELF']);
?>
<?php include '../includes/header.php'; ?>
<div class="admin-layout">
    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div>
            <div class="admin-logo">
                <i class="bi bi-shield-lock-fill"></i>
                <span>ADMIN PANEL</span>
            </div>
            <nav class="admin-nav">
                <a href="/admin/index.php"
                   class="admin-link <?= $currentAdminPage == 'index.php' ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Dashboard
                </a>
                <a href="/admin/messages.php"
                   class="admin-link <?= $currentAdminPage == 'messages.php' ? 'active' : '' ?>">
                    <i class="bi bi-envelope-fill"></i>
                    Сообщения
                </a>
            </nav>
        </div>
        <div class="admin-system-status">
            <h6 class="mb-3">Состояние системы</h6>
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
    <!-- MAIN CONTENT -->
    <main class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold">Сообщения</h1>
                <p class="text-muted mb-0">Список обращений пользователей</p>
            </div>
            <a href="/admin/index.php" class="btn btn-outline-primary">
                ← Назад
            </a>
        </div>
        <div class="info-card">
            <!-- ПОИСК -->
            <form method="GET" action="" class="mb-4">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Поиск по имени, email или тексту сообщения..."
                           value="<?= htmlspecialchars($search) ?>">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Искать
                    </button>
                    <?php if (!empty($search)): ?>
                        <a href="messages.php" class="btn btn-outline-secondary">Сбросить</a>
                    <?php endif; ?>
                </div>
            </form>
            <!-- СЧЁТЧИК -->
            <div class="d-flex justify-content-end mb-3">
                <span class="badge bg-primary fs-6">
                    <?= count($messages) ?> сообщений
                </span>
            </div>
            <!-- ТАБЛИЦА -->
            <div class="table-responsive">
                <table class="table modern-table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Сообщение</th>
                            <th>Дата</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($messages)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox" style="font-size: 48px;"></i>
                                    <p class="mt-2 mb-0">Сообщений не найдено</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($messages as $message): ?>
                                <tr>
                                    <td><?= $message['id'] ?></td>
                                    <td><?= htmlspecialchars($message['name']) ?></td>
                                    <td><?= htmlspecialchars($message['email']) ?></td>
                                    <td style="max-width: 400px;">
                                        <?= htmlspecialchars($message['message']) ?>
                                    </td>
                                    <td><?= $message['created_at'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php include '../includes/footer.php'; ?>
