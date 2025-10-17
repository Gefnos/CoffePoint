<?php
require_once '../app/functions.php';

function requireAdmin()
{
    if (!isset($_SESSION['admin'])) {
        redirect("login");
    }
}

function getAllOrders()
{
    $pdo = pdo();
    $stmt = $pdo->prepare("
        SELECT o.id, o.uid, o.total, o.status, o.created_at, u.firstname, u.surname
        FROM orders o
        LEFT JOIN users u ON o.uid = u.id
        ORDER BY o.created_at DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateOrderStatus($order_id, $status)
{
    $pdo = pdo();
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    return $stmt->execute([$status, $order_id]);
}

function getAllUsers()
{
    $pdo = pdo();
    $stmt = $pdo->prepare("SELECT id, login, firstname, surname, email, phone, role FROM users ORDER BY id");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createUser($login, $firstname, $surname, $email, $phone, $password, $role)
{
    $pdo = pdo();
    $stmt = $pdo->prepare("INSERT INTO users (login, firstname, surname, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$login, $firstname, $surname, $email, $phone, $password, $role]);
}

function updateUser($id, $login, $firstname, $surname, $email, $phone, $role, $password = null)
{
    $pdo = pdo();
    if ($password) {
        $stmt = $pdo->prepare("UPDATE users SET login = ?, firstname = ?, surname = ?, email = ?, phone = ?, role = ?, password = ? WHERE id = ?");
        return $stmt->execute([$login, $firstname, $surname, $email, $phone, $role, $password, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET login = ?, firstname = ?, surname = ?, email = ?, phone = ?, role = ? WHERE id = ?");
        return $stmt->execute([$login, $firstname, $surname, $email, $phone, $role, $id]);
    }
}

function createGood($title, $description, $price, $img_path)
{
    $pdo = pdo();
    $stmt = $pdo->prepare("INSERT INTO goods (title, description, price, img_path) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$title, $description, $price, $img_path]);
}

function updateGood($id, $title, $description, $price, $img_path = null)
{
    $pdo = pdo();
    if ($img_path) {
        $stmt = $pdo->prepare("UPDATE goods SET title = ?, description = ?, price = ?, img_path = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $price, $img_path, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE goods SET title = ?, description = ?, price = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $price, $id]);
    }
}