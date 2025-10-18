<?php
require_once 'core/boot.php';

function getCurrentUser(int $id)
{
    $stmt = pdo()->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getUserByLogin(string $login)
{
    $stmt = pdo()->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    return $stmt->fetch();
}
function getLastThreeGoods()
{
    $stmt = pdo()->prepare("SELECT * FROM goods ORDER BY id DESC LIMIT 3");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function createOrder($user_id, $items, $total)
{
    try {
        pdo()->beginTransaction();

        // Создаём основной заказ со статусом "В обработке"
        $stmt = pdo()->prepare("INSERT INTO orders (uid, total, status, created_at) VALUES (?, ?, 'В обработке', NOW())");
        $stmt->execute([$user_id, $total]);
        $order_id = pdo()->lastInsertId();

        // Добавляем позиции заказа
        $stmt_item = pdo()->prepare("INSERT INTO order_items (order_id, gid, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($items as $item) {
            $stmt_item->execute([
                $order_id,
                $item['gid'],
                $item['quantity'],
                $item['price']
            ]);
        }

        pdo()->commit();
        return $order_id;

    } catch (Exception $e) {
        pdo()->rollBack();
        error_log("Ошибка создания заказа: " . $e->getMessage());
        return false;
    }
}
function getGoodById($gid)
{
    $stmt = pdo()->prepare("SELECT * FROM goods WHERE id = ?");
    $stmt->execute([$gid]);
    return $stmt->fetch();
}
function isLogged()
{
    $isLogged = isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']);
    !$isLogged ? $_SESSION['last_error'] = "Вам нужно авторизоваться" : $_SESSION['last_error'] = '';
    return $isLogged;
}
function getAllGoods()
{
    $stmt = pdo()->prepare("SELECT * FROM goods");
    $stmt->execute();
    return $stmt->fetchAll();
}
function redirect(string $url, string $anchor = '')
{
    header("Location: http://localhost:9090/CoffePoint/$url.php$anchor");
    exit;
}
function addToCart(int $gid, int $quantity = 1)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($gid <= 0 || $quantity <= 0) {
        return false;
    }

    if (isset($_SESSION['cart'][$gid])) {
        $_SESSION['cart'][$gid] += $quantity;
    } else {
        $_SESSION['cart'][$gid] = $quantity;
    }

    return true;
}
/**
 * Получить статистику заказов пользователя
 * @param int $uid
 * @return array
 */
function getUserOrderStats($uid)
{
    $pdo = pdo();
    $stmt = $pdo->prepare("
        SELECT 
            COUNT(*) as total_orders,
            SUM(total) as total_spent,
            SUM(CASE WHEN status IN ('В обработке', 'Готовится', 'Готов к выдаче') THEN total ELSE 0 END) as current_spent
        FROM orders WHERE uid = ?
    ");
    $stmt->execute([$uid]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
/**
 * Получить все заказы пользователя
 * @param int $uid
 * @return array
 */
function getUserOrders($uid)
{
    $pdo = pdo();
    $stmt = $pdo->prepare("
        SELECT id, total, status, created_at
        FROM orders
        WHERE uid = ?
        ORDER BY created_at DESC
    ");
    $stmt->execute([$uid]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Получить заказ по ID
 * @param int $id
 * @return array|null
 */
function getOrderById($id)
{
    $pdo = pdo();
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Получить позиции заказа по ID заказа
 * @param int $order_id
 * @return array
 */
function getOrderItemsByOrderId($order_id)
{
    $pdo = pdo();
    $stmt = $pdo->prepare("
        SELECT oi.*, g.title, g.img_path
        FROM order_items oi
        JOIN goods g ON oi.gid = g.id
        WHERE oi.order_id = ?
    ");
    $stmt->execute([$order_id]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($items as &$item) {
        $item['sum'] = $item['price'] * $item['quantity'];
    }
    return $items;
}
function updateUserProfile($id, $firstname, $surname, $age, $email, $phone)
{
    $pdo = pdo();
    $stmt = $pdo->prepare("UPDATE users SET firstname = ?, surname = ?, age = ?, email = ?, phone = ? WHERE id = ?");
    return $stmt->execute([$firstname, $surname, $age, $email, $phone, $id]);
}
/**
 * Проверить, является ли пользователь админом
 * @return bool
 */
function isAdmin()
{
    return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 1;
}
