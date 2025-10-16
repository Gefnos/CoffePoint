<?php
$pageData = [
    "css" => ["css/style.css"]
];
require_once 'templates/header.php';
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
            <!-- Пример 6 товаров -->
            <div class="product-card">
                <img src="assets/images/эспрессо.png" alt="Эспрессо"
                    class="product-img">
                <div class="product-info">
                    <h3>Эспрессо</h3>
                    <p>Крепкий и насыщенный кофе в чистом виде.</p>
                    <p class="price">250 ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1522992319-0365e5f11656" alt="Капучино" class="product-img">
                <div class="product-info">
                    <h3>Капучино</h3>
                    <p>Кофе с молочной пенкой и какао.</p>
                    <p class="price">350 ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1561049907-78ca6580d6f6" alt="Латте" class="product-img">
                <div class="product-info">
                    <h3>Латте</h3>
                    <p>Мягкий и сливочный кофе с молоком.</p>
                    <p class="price">300 ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348" alt="Американо"
                    class="product-img">
                <div class="product-info">
                    <h3>Американо</h3>
                    <p>Разбавленный эспрессо водой, с мягкой горчинкой.</p>
                    <p class="price">270 ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1554679665-f5537f187268" alt="Мокко" class="product-img">
                <div class="product-info">
                    <h3>Мокко</h3>
                    <p>Кофе с шоколадом и взбитыми сливками.</p>
                    <p class="price">380 ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b" alt="Флэт Уайт"
                    class="product-img">
                <div class="product-info">
                    <h3>Флэт Уайт</h3>
                    <p>Похож на латте, но с более насыщенным вкусом кофе.</p>
                    <p class="price">320 ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1559496417-e7f25cb247f3" alt="Чай" class="product-img">
                <div class="product-info">
                    <h3>Чай</h3>
                    <p>Зелёный, чёрный, фруктовый — на выбор.</p>
                    <p class="price">150 ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1541592106381-b31e9677c0e5" alt="Круассан"
                    class="product-img">
                <div class="product-info">
                    <h3>Круассан</h3>
                    <p>Свежий, слоёный, с маслом.</p>
                    <p class="price">120 ₽</p>
                    <button class="add-to-cart">В корзину</button>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'templates/footer.php'; ?>