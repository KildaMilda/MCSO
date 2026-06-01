<?php

$host = 'localhost';
$dbname = 'mcso';
$username = 'mcso_user';
$password = 'P@ssw0rd';

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Ошибка подключения к БД: " . $e->getMessage());

}
