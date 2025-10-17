<?php
session_start();
require_once 'functions.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-status'])) {
    $order_id = (int) $_POST['order_id'];
    $status = $_POST['status'];
    updateOrderStatus($order_id, $status);
    header("Location: orders.php");
    exit;
}

$orders = getAllOrders();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Заказы | Админка</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th,
        td {
            padding: 0.8rem;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f5f0e6;
        }

        .status-form {
            display: inline-block;
        }

        .status-form select {
            padding: 0.2rem;
        }

        .status-form button {
            padding: 0.2rem 0.5rem;
            margin-left: 0.3rem;
            background-color: #6d4c41;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include '../templates/admin_header.php'; ?>

    <div class="admin-content">
        <h2>Заказы</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= htmlspecialchars($order['firstname'] . ' ' . $order['surname']) ?></td>
                        <td><?= number_format($order['total'], 2, '.', ' ') ?> ₽</td>
                        <td>
                            <form method="POST" class="status-form">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <select name="status">
                                    <option value="В обработке" <?= $order['status'] === 'В обработке' ? 'selected' : '' ?>>В
                                        обработке</option>
                                    <option value="Готовится" <?= $order['status'] === 'Готовится' ? 'selected' : '' ?>>
                                        Готовится</option>
                                    <option value="Готов к выдаче" <?= $order['status'] === 'Готов к выдаче' ? 'selected' : '' ?>>Готов к выдаче</option>
                                    <option value="Завершен" <?= $order['status'] === 'Завершен' ? 'selected' : '' ?>>Завершен
                                    </option>
                                </select>
                                <button type="submit" name="update-status">Сохранить</button>
                            </form>
                        </td>
                        <td><?= $order['created_at'] ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>