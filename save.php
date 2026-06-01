<?php
require 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
        if (empty($email)) {
            die('Email обязателен');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Некорректный email');
        }
        if (strlen($email) > 255) {
            die('Слишком длинный email');
        }
    $message = trim($_POST['message']);
    /*
     * Защита от XSS
     */
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $message = htmlspecialchars($message);
    /*
     * Prepared Statement
     */
    $stmt = $pdo->prepare(
        "INSERT INTO messages (name, email, message)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([
        $name,
        $email,
        $message
    ]);
    header("Location: form.php?success=1");
    exit;
}
