<?php
session_start();
require_once 'functions.php';
requireAdmin();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Админка | CoffePoint</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        .admin-nav {
            margin-bottom: 2rem;
        }

        .admin-nav a {
            display: inline-block;
            margin-right: 1rem;
            padding: 0.5rem 1rem;
            background-color: #6d4c41;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .admin-nav a:hover {
            background-color: #3e2723;
        }

        .admin-content {
            padding: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php include '../templates/admin_header.php'; ?>

    <div class="admin-content">
        <h1>Панель управления</h1>
        <p>Добро пожаловать, <?= htmlspecialchars($_SESSION['admin']['firstname']) ?>!</p>

        <div class="admin-nav">
            <a href="orders.php">Управление заказами</a>
            <a href="users.php">Управление пользователями</a>
            <a href="goods.php">Управление товарами</a>
            <a href="logout.php">Выйти</a>
        </div>
    </div>
</body>

</html>