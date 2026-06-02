<?php
session_start();
// Проверка CSRF
if (
    !isset($_POST['csrf_token']) ||
    !isset($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    die('Недействительный CSRF-токен');
}
require 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    // Валидация
    $errors = [];
    // Проверка имени
    if (empty($name)) {
        $errors[] = 'Имя обязательно для заполнения';
    } elseif (strlen($name) > 100) {
        $errors[] = 'Имя не должно превышать 100 символов';
    } elseif (!preg_match('/^[\p{L}\s\-\.]+$/u', $name)) {
        $errors[] = 'Имя может содержать только буквы, пробелы, дефисы и точки';
    }
    // Проверка email
    if (empty($email)) {
        $errors[] = 'Email обязателен для заполнения';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Введите корректный email адрес';
    } elseif (strlen($email) > 255) {
        $errors[] = 'Email не должен превышать 255 символов';
    }
    // Проверка сообщения
    if (empty($message)) {
        $errors[] = 'Сообщение не может быть пустым';
    } elseif (strlen($message) > 5000) {
        $errors[] = 'Сообщение не должно превышать 5000 символов';
    } elseif (strlen($message) < 10) {
        $errors[] = 'Сообщение должно содержать минимум 10 символов';
    }
    // Если есть ошибки — возвращаем на форму
    if (!empty($errors)) {
        $errorString = implode('. ', $errors);
        $_SESSION['old_input'] = [
            'name' => $name,
            'email' => $email,
            'message' => $message
        ];
        header("Location: form.php?error=" . urlencode($errorString));
        exit;
    }
    // Безопасное экранирование перед сохранением
    $name_safe = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $email_safe = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $message_safe = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    // Сохраняем в БД
    try {
        $stmt = $pdo->prepare(
            "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)"
        );
        $stmt->execute([$name_safe, $email_safe, $message_safe]);
        // Удаляем CSRF-токен после успешной отправки
        unset($_SESSION['csrf_token']);
        
        header("Location: form.php?success=1");
        exit;
    } catch (PDOException $e) {
        error_log("Ошибка сохранения сообщения: " . $e->getMessage());
        $_SESSION['old_input'] = [
            'name' => $name,
            'email' => $email,
            'message' => $message
        ];
        header("Location: form.php?error=Ошибка сервера. Попробуйте позже.");
        exit;
    }
} else {
    // Не POST-запрос
    header("Location: form.php");
    exit;
}
?>
