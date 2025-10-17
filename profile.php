<?php
session_start();
$pageData = [
    "css" => ["css/style.css", "css/profile.css"]
];
require_once 'app/functions.php';

// Получаем данные пользователя
$user = getCurrentUser($_SESSION['user']['id']);
if (!$user) {
    $_SESSION['last_error'] = "Пользователь не найден.";
    header("Location: index.php");
    exit;
}

// Получаем статистику заказов
$stats = getUserOrderStats($user['id']);
$total_orders = $stats['total_orders'] ?? 0;
$total_spent = $stats['total_spent'] ?? 0;
$current_spent = $stats['current_spent'] ?? 0;

// Получаем заказы
$orders = getUserOrders($user['id']);

// Разделяем заказы на текущие и завершённые
$current_orders = [];
$completed_orders = [];

foreach ($orders as $order) {
    if ($order['status'] === 'В обработке' || $order['status'] === 'Готовится' || $order['status'] === 'Готов к выдаче') {
        $current_orders[] = $order;
    } else {
        $completed_orders[] = $order;
    }
}

require_once 'templates/header.php';
?>

<!-- Profile Content -->
<main class="profile-container">
    <div class="profile-header">
        <img src="https://ionoto.ru/upload/medialibrary/a1f/tcs61nk83dig738gik8qtkcx6ue7sgek.png"
            alt="Аватар пользователя" class="profile-avatar">
        <div class="profile-info">
            <h1><?= htmlspecialchars($user['firstname'] . " " . $user['surname']) ?></h1>
            <p>Возраст: <?= (int) $user['age'] ?> лет</p>
            <p>Email: <?= htmlspecialchars($user['email']) ?></p>
            <p>Телефон: <?= htmlspecialchars($user['phone']) ?></p>
            <p>Статус: <?= htmlspecialchars($user['status']) ?></p>
        </div>
    </div>

    <div class="profile-stats">
        <div class="stat-card">
            <h3>Всего заказов</h3>
            <p><?= (int) $total_orders ?></p>
        </div>
        <div class="stat-card">
            <h3>Сумма всех заказов</h3>
            <p><?= number_format($total_spent, 2, '.', ' ') ?> ₽</p>
        </div>
        <div class="stat-card">
            <h3>Сумма текущих заказов</h3>
            <p><?= number_format($current_spent, 2, '.', ' ') ?> ₽</p>
        </div>
    </div>

    <div class="profile-orders">
        <div class="order-section">
            <h2>Текущие заказы</h2>
            <div class="order-list">
                <?php if (empty($current_orders)): ?>
                    <p>Нет текущих заказов.</p>
                <?php else: ?>
                    <?php foreach ($current_orders as $order): ?>
                        <div class="order-card">
                            <h4>Заказ #<?= (int) $order['id'] ?></h4>
                            <p><?= number_format($order['total'], 2, '.', ' ') ?> ₽</p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="order-section">
            <h2>Завершённые заказы</h2>
            <div class="order-list">
                <?php if (empty($completed_orders)): ?>
                    <p>Нет завершённых заказов.</p>
                <?php else: ?>
                    <?php foreach ($completed_orders as $order): ?>
                        <div class="order-card">
                            <h4>Заказ #<?= (int) $order['id'] ?></h4>
                            <p><?= number_format($order['total'], 2, '.', ' ') ?> ₽</p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once 'templates/footer.php' ?>