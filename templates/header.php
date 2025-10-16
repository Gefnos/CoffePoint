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
        <nav class="nav-links">
            <a href="index.html">Главная</a>
            <a href="goods.html">Товары</a>
            <a href="#about">О нас</a>
            <?php if (!isLogged()): ?>
                <a href="login.php">Войти</a>
            <?php else: ?>
                <a href="">Добро пожаловать, <?= $_SESSION['user']['name'] ?></a>
            <?php endif; ?>
        </nav>
    </header>