<?php
session_start();
require_once '../functions.php';
require_once '../core/boot.php';


if (isset($_POST['add-to-card'])) {
    $gid = $_POST['gid'];
    $q = $_POST['quantity'];
    if ($gid > 0 && $q > 0) {
        addToCart($gid, $q);
    }
    $_SESSION['alerts']['info'] = "Подтвердите заказ в разделе <Корзина>!";
    redirect("goods", "#products");
}

if (isset($_POST['update-cart'])) {

    $quantities = $_POST['quantities'] ?? [];
    foreach ($quantities as $gid => $qty) {
        $gid = (int) $gid;
        $qty = (int) $qty;
        if ($qty <= 0) {
            unset($_SESSION['cart'][$gid]);
        } else {
            $_SESSION['cart'][$gid] = $qty;
        }
    }
    $_SESSION['alerts']['info'] = "Корзина обновлена.";
    redirect("cart");

}

if (isset($_POST['purchase-cart'])) {

    // Проверяем, есть ли товары в корзине
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        $_SESSION['last_error'] = "Корзина пуста.";
        redirect("cart");
    }

    // Получаем товары из корзины
    $cart = $_SESSION['cart'];

    // Получаем ID товаров и их количество
    $items = [];
    $total = 0;

    foreach ($cart as $gid => $quantity) {
        $product = getGoodById($gid); // функция, которая возвращает товар по ID
        if ($product) {
            $items[] = [
                'gid' => $gid,
                'title' => $product['title'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'sum' => $product['price'] * $quantity
            ];
            $total += $product['price'] * $quantity;
        }
    }

    if (empty($items)) {
        $_SESSION['last_error'] = "Некоторые товары больше не доступны.";
        redirect("cart");
    }

    // Запись заказа в БД
    $user_id = $_SESSION['user']['id'] ?? null; // если есть авторизация

    $order_id = createOrder($user_id, $items, $total);
    if ($order_id) {
        // Очищаем корзину
        unset($_SESSION['cart']);
        $_SESSION['alerts']['success'] = "Заказ №{$order_id} успешно оформлен!";
    } else {
        $_SESSION['last_error'] = "Ошибка при оформлении заказа.";
    }

    redirect("profile");
}