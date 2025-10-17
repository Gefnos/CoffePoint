<?php
session_start();
$pageData = [
    "css" => ["css/style.css"]
];
require_once 'templates/header.php';
require_once 'app/functions.php';

$products = getLastThreeGoods();


?>

<!-- Hero -->
<section class="hero">
    <h1>Добро пожаловать в CoffePoint</h1>
    <p>Насладитесь ароматным кофе, приготовленным с любовью, в уютной атмосфере настоящей кофейни.</p>
</section>

<!-- Products -->
<section id="products" class="products">
    <h2 class="section-title" style="display: flex; flex-direction: column;">
        Новые продукты
        <a href="http://localhost:9090/CoffePoint/goods.php" class="view-all" style="font-size: 18px">Посмотреть все товары</a>
    </h2>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <?php require 'templates/product-card.php' ?>
        <?php endforeach; ?>
    </div>
</section>

<!-- About -->
<section id="about" class="about">
    <div class="about-text">
        <h2>О нас</h2>
        <p>Кофейня CoffePoint — это место, где встречается аромат, тепло и уют. Мы отбираем лучшие сорта кофе, чтобы
            каждый гость получил удовольствие от напитка.</p>
        <p>У нас вы найдете не только вкусный кофе, но и уютную атмосферу, удобные диваны и бесплатный Wi-Fi.</p>
    </div>
    <div class="about-image">
        <img src="assets/images/index-bg.webp" alt="Кофейня">
    </div>
</section>

<!-- Contacts -->
<section class="contacts">
    <div class="contact-info">
        <h2>Контакты</h2>
        <p>ул. Кофейная, 10, г. Камышин</p>
        <p>+7 (123) 456-78-90</p>
        <p>info@coffeepoint.ru</p>
        <address>Открыты с 8:00 до 22:00</address>
    </div>
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2560.300401819348!2d45.401744376934815!3d50.080662313919895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4111715ecdc079e1%3A0xe089a38ddc0239c5!2z0JrQvtGE0LUg0KLQvtGH0LrQsCDQndC10L7QvQ!5e0!3m2!1sru!2sru!4v1760616996484!5m2!1sru!2sru"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<?php require_once 'templates/footer.php' ?>