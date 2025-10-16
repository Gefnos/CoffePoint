<?php

require_once '../core/boot.php';
require_once '../functions.php';

$stmt = pdo()->prepare("SELECT login FROM users WHERE login = ?");
$stmt->execute([$_POST['login']]);
if ($stmt->rowCount()) {
    $_SESSION['last_error'] = "Пользователь с таким логином уже существует";
    redirect('reg');
} else {
    $stmt = pdo()->prepare("INSERT INTO users 
            (login, password, email, age) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['login'],
        $_POST['password'],
        $_POST['email'],
        $_POST['age']
    ]);
    // redirect('login');
}

