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

// Обработка POST-запроса на обновление данных
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-profile'])) {
    $firstname = trim($_POST['firstname']);
    $surname = trim($_POST['surname']);
    $age = (int) $_POST['age'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Валидация
    if (empty($firstname) || empty($surname) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['last_error'] = "Пожалуйста, заполните все обязательные поля корректно.";
    } else {
        $result = updateUserProfile($user['id'], $firstname, $surname, $age, $email, $phone);
        if ($result) {
            $_SESSION['alerts']['info'] = "Профиль успешно обновлён!";
            // Обновляем данные в сессии
            $user = getCurrentUser($user['id']);
        } else {
            $_SESSION['last_error'] = "Ошибка при обновлении профиля.";
        }
    }
    header("Location: profile.php");
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
            <!-- Блок с данными пользователя -->
            <div id="profile-data">
                <h1><?= htmlspecialchars($user['firstname'] . " " . $user['surname']) ?></h1>
                <p>Возраст: <?= (int) $user['age'] ?> лет</p>
                <p>Email: <?= htmlspecialchars($user['email']) ?></p>
                <p>Телефон: <?= htmlspecialchars($user['phone']) ?></p>
                <p>Статус: <?= htmlspecialchars($user['status']) ?></p>
                <button id="edit-btn"
                    style="margin-top: 1rem; padding: 0.5rem 1rem; background-color: var(--medium-brown); color: var(--white); border: none; border-radius: 5px; cursor: pointer;">Редактировать
                    профиль</button>
            </div>

            <!-- Форма редактирования (скрыта по умолчанию) -->
            <form method="POST" id="profile-form" style="display: none;">
                <h1>
                    <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required
                        style="width: 40%; font-size: 1.5rem; font-weight: bold; border: 1px solid var(--light-brown); border-radius: 5px; padding: 0.2rem;">
                    <input type="text" name="surname" value="<?= htmlspecialchars($user['surname']) ?>" required
                        style="width: 40%; font-size: 1.5rem; font-weight: bold; border: 1px solid var(--light-brown); border-radius: 5px; padding: 0.2rem;">
                </h1>
                <p>Возраст: <input type="number" name="age" value="<?= (int) $user['age'] ?>" min="1" max="120" required
                        style="width: 100px; border: 1px solid var(--light-brown); border-radius: 5px; padding: 0.2rem;">
                </p>
                <p>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required
                        style="width: 50%; border: 1px solid var(--light-brown); border-radius: 5px; padding: 0.2rem;">
                </p>
                <p>Телефон: <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>"
                        style="width: 50%; border: 1px solid var(--light-brown); border-radius: 5px; padding: 0.2rem;">
                </p>
                <p>Статус: <?= htmlspecialchars($user['status']) ?></p>
                <button type="submit" name="update-profile"
                    style="margin-top: 1rem; padding: 0.5rem 1rem; background-color: var(--medium-brown); color: var(--white); border: none; border-radius: 5px; cursor: pointer;">Сохранить
                    изменения</button>
                <button type="button" id="cancel-btn"
                    style="margin-top: 1rem; margin-left: 0.5rem; padding: 0.5rem 1rem; background-color: var(--light-brown); color: var(--dark-brown); border: none; border-radius: 5px; cursor: pointer;">Отмена</button>
            </form>
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
                            <a href="http://localhost:9090/CoffePoint/view-order.php?id=<?= (int) $order['id'] ?>">
                                <h4>Заказ #<?= (int) $order['id'] ?></h4>
                            </a>
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
                            <a href="http://localhost:9090/CoffePoint/view-order.php?id=<?= (int) $order['id'] ?>">
                                <h4>Заказ #<?= (int) $order['id'] ?></h4>
                            </a>
                            <p><?= number_format($order['total'], 2, '.', ' ') ?> ₽</p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('edit-btn');
        const cancelBtn = document.getElementById('cancel-btn');
        const profileData = document.getElementById('profile-data');
        const profileForm = document.getElementById('profile-form');

        editBtn.addEventListener('click', function () {
            profileData.style.display = 'none';
            profileForm.style.display = 'block';
        });

        cancelBtn.addEventListener('click', function () {
            profileForm.style.display = 'none';
            profileData.style.display = 'block';
        });
    });
</script>

<?php require_once 'templates/footer.php'; ?>