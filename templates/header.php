<?php require_once './app/functions.php'; ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoffePoint - Лучшая кофейня</title>
    <?php if (isset($pageData) && !empty($pageData)): ?>
        <?php if (isset($pageData['css']) && !empty($pageData['css'])): ?>
            <?php foreach ($pageData['css'] as $css): ?>
                <link rel="stylesheet" href="<?= htmlspecialchars($css) ?>">
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <span>☕</span>
            <h1>CoffePoint</h1>
        </div>
        <div class="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="nav-links">
            <a href="http://localhost:9090/CoffePoint/index.php">Главная</a>
            <a href="http://localhost:9090/CoffePoint/goods.php">Товары</a>
            <?php if (isLogged()): ?>
                <a href="http://localhost:9090/CoffePoint/cart.php">Корзина</a>
            <?php endif; ?>
            <a href="http://localhost:9090/CoffePoint/index.php#about">О нас</a>
            <?php if (!isLogged()): ?>
                <a href="http://localhost:9090/CoffePoint/login.php">Войти</a>
            <?php else: ?>
                <a href="http://localhost:9090/CoffePoint/profile.php">Добро пожаловать,
                    <?= $_SESSION['user']['name'] ?></a>
                <a href="http://localhost:9090/CoffePoint/logout.php">Выйти</a>
            <?php endif; ?>
        </nav>
    </header>
    <script>
        const burger = document.querySelector('.burger');
        const navLinks = document.querySelector('.nav-links');

        burger.addEventListener('click', () => {
            burger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        // Закрыть меню при клике на ссылку
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                burger.classList.remove('active');
                navLinks.classList.remove('active');
            });
        });
    </script>