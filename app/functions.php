<?php
require_once 'core/boot.php';

function getCurrentUser($id)
{
    $stmt = pdo()->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getLastThreeGoods()
{
    $stmt = pdo()->prepare("SELECT * FROM goods ORDER BY id DESC LIMIT 3");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
function redirect($url)
{
    header("Location: http://localhost:9090/CoffePoint/$url.php");
    exit;
}
