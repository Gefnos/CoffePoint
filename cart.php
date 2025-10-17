<?php
session_start();
require_once 'app/functions.php';

$pageData = [
    "css" => ["css/style.css", "css/cart.css"]
];

$cart = $_SESSION['cart'] ?? [];
$items = [];
$total = 0;

if (!empty($cart)) {
    foreach ($cart as $gid => $quantity) {
        $product = getGoodById($gid);
        if ($product) {
            $item_total = $product['price'] * $quantity;
            $items[] = [
                'id' => $product['id'],
                'title' => $product['title'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'sum' => $item_total
            ];
            $total += $item_total;
        }
    }
}
?>

<?php require_once 'templates/header.php'; ?>

<main class="cart-container">
    <h2>Ваша корзина</h2>

    <?php if (empty($items)): ?>
        <div class="empty-cart">
            <p>Ваша корзина пуста.</p>
        </div>
    <?php else: ?>
        <form method="POST" action="app/actions/do_order.php">
            <div class="cart-header">
                <div>Товар</div>
                <div>Цена</div>
                <div>Количество</div>
                <div>Сумма</div>
            </div>

            <?php foreach ($items as $item): ?>
                <div class="cart-item">
                    <div>
                        <div class="cart-item-info">
                            <span class="cart-item-name"><?= $item['title'] ?></span>
                        </div>
                    </div>
                    <div class="cart-item-price"><?= $item['price'] ?> ₽</div>
                    <div>
                        <input type="number" name="quantities[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="0"
                            max="10">
                    </div>
                    <div><?= $item['sum'] ?> ₽</div>
                </div>
            <?php endforeach; ?>

            <div class="cart-total">
                <h3>Итого: <?= $total ?> ₽</h3>
            </div>

            <input type="submit" name="update-cart" value="Обновить корзину" class="checkout-btn">
            <input type="submit" name="purchase-cart" value="Оформить заказ" class="checkout-btn"
                style="background-color: #3e8e41;">
        </form>
    <?php endif; ?>
</main>
<?php require_once 'templates/footer.php'; ?>