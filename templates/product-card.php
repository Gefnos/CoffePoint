<div class="product-card">
    <img src="<?= $product['img_path'] ?>" alt="<?= $product['title'] ?>" class="product-img">
    <div class="product-content">
        <div class="product-header">
            <h3><?= $product['title'] ?></h3>
            <p><?= $product['description'] ?></p>
        </div>
        <div class="good-info-wrapper">
            <form class="product-info" action="app/actions/do_order.php" method="POST">
                <div class="good-info">
                    <p class="price"><?= $product['price'] ?> ₽</p>
                    <input type="number" name="quantity" min="1" max="10" required placeholder="1">
                </div>

                <input type="hidden" name="gid" value="<?= $product['id'] ?>">
                <input type="submit" name="add-to-card" class="add-to-cart" value="В корзину">
            </form>
        </div>
    </div>
</div>