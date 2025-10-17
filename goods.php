<?php
session_start();
$pageData = [
    "css" => ["css/style.css"]
];
require_once 'templates/header.php';
require_once 'app/functions.php';

$products = getAllGoods();

?>

<!-- Hero -->
<section class="hero">
    <h1>Все товары</h1>
    <p>Выберите свой идеальный напиток</p>
</section>

<!-- Products Grid -->
<section id="products" class="products">
    <h2 class="section-title">Наша продукция</h2>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <?php require 'templates/product-card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>


<?php require_once 'templates/footer.php'; ?>