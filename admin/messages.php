<?php
require '../includes/admin_auth.php';
require '../config/db.php';
$stmt = $pdo->query(
    "SELECT * FROM messages
     ORDER BY created_at DESC"
);
$messages = $stmt->fetchAll();
?>
<?php include '../includes/header.php'; ?>
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>
                    Сообщения
                </h1>
                <p class="text-muted mb-0">
                    Список обращений пользователей
                </p>
            </div>
            <a href="/admin/index.php"
               class="btn btn-outline-primary">
                Назад
            </a>
        </div>
        <div class="info-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" class="form-control w-50" placeholder="Поиск сообщений...">
                <span class="badge bg-primary fs-6">
                    <?= count($messages) ?> сообщений
                </span>
            </div>
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
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td>
                                <?= $message['id'] ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($message['name']) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($message['email']) ?>
                            </td>
                            <td style="max-width: 300px;">
                                <?= htmlspecialchars($message['message']) ?>
                            </td>
                            <td>
                                <?= $message['created_at'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include '../includes/footer.php'; ?>