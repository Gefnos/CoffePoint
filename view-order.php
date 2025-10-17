<?php
session_start();
require_once 'app/functions.php';

// Проверяем, авторизован ли пользователь
if (!isLogged()) {
    $_SESSION['last_error'] = "Для просмотра заказа необходимо войти в аккаунт.";
    header("Location: login.php");
    exit;
}

// Получаем ID заказа из URL
$order_id = (int) ($_GET['id'] ?? 0);

if ($order_id <= 0) {
    $_SESSION['last_error'] = "Неверный ID заказа.";
    header("Location: profile.php");
    exit;
}

// Получаем данные заказа
$order = getOrderById($order_id);

if (!$order) {
    $_SESSION['last_error'] = "Заказ не найден.";
    header("Location: profile.php");
    exit;
}

// Проверяем, принадлежит ли заказ текущему пользователю (или админу)
if ($order['uid'] !== $_SESSION['user']['id'] && !isAdmin()) {
    $_SESSION['last_error'] = "У вас нет доступа к этому заказу.";
    header("Location: profile.php");
    exit;
}

// Получаем позиции заказа
$order_items = getOrderItemsByOrderId($order_id);

$pageData = [
    "css" => ["css/style.css"]
];
require_once 'templates/header.php';
?>

<main class="order-view-container">
    <h1>Заказ №<?= $order['id'] ?></h1>

    <div class="order-summary">
        <p><strong>Дата:</strong> <?= $order['created_at'] ?></p>
        <p><strong>Статус:</strong>
            <span
                class="status-<?= $order['status'] === 'В обработке' ? 'processing' : ($order['status'] === 'Готовится' ? 'preparing' : ($order['status'] === 'Готов к выдаче' ? 'ready' : 'completed')) ?>">
                <?= htmlspecialchars($order['status']) ?>
            </span>
        </p>
        <p><strong>Сумма заказа:</strong> <?= number_format($order['total'], 2, '.', ' ') ?> ₽</p>
    </div>

    <h2>Состав заказа</h2>
    <div class="order-items">
        <?php if (empty($order_items)): ?>
            <p>В заказе нет товаров.</p>
        <?php else: ?>
            <table class="order-items-table">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена за шт.</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items as $item): ?>
                        <tr>
                            <td>
                                <img src="<?= htmlspecialchars($item['img_path'] ?? 'https://via.placeholder.com/80') ?>"
                                    alt="изображение" style="height: 50px; margin-right: 10px;">
                                <?= htmlspecialchars($item['title']) ?>
                            </td>
                            <td><?= number_format($item['price'], 2, '.', ' ') ?> ₽</td>
                            <td><?= (int) $item['quantity'] ?></td>
                            <td><?= number_format($item['sum'], 2, '.', ' ') ?> ₽</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>

<style>
    .order-view-container {
        padding: 3rem 5%;
        max-width: 1200px;
        margin: 0 auto;
        background-color: var(--white);
        border-radius: 10px;
        box-shadow: var(--shadow);
        margin-top: 2rem;
        margin-bottom: 3rem;
    }

    .order-summary {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--secondary-beige);
    }

    .status-processing {
        color: orange;
    }

    .status-preparing {
        color: #FFA500;
    }

    .status-ready {
        color: #007BFF;
    }

    .status-completed {
        color: green;
    }

    .order-items-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .order-items-table th,
    .order-items-table td {
        padding: 1rem;
        border: 1px solid var(--secondary-beige);
        text-align: left;
    }

    .order-items-table th {
        background-color: var(--primary-beige);
    }

    .order-items-table img {
        vertical-align: middle;
    }
</style>

<?php require_once 'templates/footer.php'; ?>