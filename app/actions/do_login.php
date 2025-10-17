<?php
session_start();
require_once '../core/boot.php';
require_once '../functions.php';

$stmt = pdo()->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
$stmt->execute([$_POST['login'], $_POST['password']]);
$user = $stmt->fetch();

if ($stmt->rowCount()) {
    if($user['role'] === "1"){
        $_SESSION['user']['isAdmin'] = true;
    }
    $_SESSION['user']['id'] = $user['id'];
    $_SESSION['user']['name'] = $user['firstname'];
    $_SESSION['user']['surname'] = $user['surname'];
    redirect("profile");
} else {
    $_SESSION['last_error'] = "Данные введены неверно!";
    redirect('login');
}

?>