<?php
require_once '../admin/functions.php';
requireAdmin();
?>
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
<div class="admin-content">
    <h1>Панель управления</h1>
    <p>Добро пожаловать, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</p>

    <div class="admin-nav">
        <a href="http://localhost:9090/CoffePoint/index.php">На главную</a>
        <a href="http://localhost:9090/CoffePoint/admin/orders.php">Управление заказами</a>
        <a href="http://localhost:9090/CoffePoint/admin/users.php">Управление пользователями</a>
        <a href="http://localhost:9090/CoffePoint/admin/goods.php">Управление товарами</a>
        <a href="http://localhost:9090/CoffePoint/logout.php">Выйти</a>
    </div>
</div>