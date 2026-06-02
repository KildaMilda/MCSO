<?php
$env = parse_ini_file(__DIR__ . '/../.env');
if ($env === false) {
    // Файл .env не найден — выдаём понятную ошибку
    die('Ошибка конфигурации: файл .env не найден. Обратитесь к администратору.');
}
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
}
?>
