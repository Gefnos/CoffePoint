<?php
$pageData = [
    "css" => ["css/style.css", "css/profile.css"]
];
require_once 'templates/header.php';
?>

<!-- Profile Content -->
<main class="profile-container">
    <div class="profile-header">
        <img src="https://via.placeholder.com/150" alt="Аватар пользователя" class="profile-avatar">
        <div class="profile-info">
            <h1>Иван Петров</h1>
            <p>Возраст: 28 лет</p>
            <p>Email: ivan.petrov@example.com</p>
            <p>Телефон: +7 (999) 123-45-67</p>
            <p>Статус: Постоянный клиент</p>
        </div>
    </div>

    <div class="profile-stats">
        <div class="stat-card">
            <h3>Всего заказов</h3>
            <p>24</p>
        </div>
        <div class="stat-card">
            <h3>Сумма всех заказов</h3>
            <p>8 450 ₽</p>
        </div>
        <div class="stat-card">
            <h3>Сумма текущих заказов</h3>
            <p>1 200 ₽</p>
        </div>
    </div>

    <div class="profile-orders">
        <div class="order-section">
            <h2>Текущие заказы</h2>
            <div class="order-list">
                <div class="order-card">
                    <h4>Заказ #1001</h4>
                    <p>1 200 ₽</p>
                </div>
            </div>
        </div>

        <div class="order-section">
            <h2>Завершённые заказы</h2>
            <div class="order-list">
                <div class="order-card">
                    <h4>Заказ #999</h4>
                    <p>850 ₽</p>
                </div>
                <div class="order-card">
                    <h4>Заказ #998</h4>
                    <p>1 100 ₽</p>
                </div>
                <div class="order-card">
                    <h4>Заказ #997</h4>
                    <p>750 ₽</p>
                </div>
                <div class="order-card">
                    <h4>Заказ #996</h4>
                    <p>950 ₽</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'templates/footer.php' ?>