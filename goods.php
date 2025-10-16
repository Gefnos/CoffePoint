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
    <p>Выберите свой идеальный напиток или десерт</p>
</section>

<!-- Products Grid -->
<section class="products">
    <h2 class="section-title">Наша продукция</h2>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?= $product['img_path'] ?>" alt="<?= $product['title'] ?>" class="product-img">
                <div class="product-info">
                    <h3><?= $product['title'] ?></h3>
                    <p><?= $product['description'] ?></p>
                    <p class="price"><?= $product['price'] ?> ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once 'templates/footer.php'; ?>