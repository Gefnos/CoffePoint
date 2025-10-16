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
    $stmt = pdo()->prepare("SELECT * FROM goods LIMIT 3 ORDER BY DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function isLogged()
{
    $isLogged = isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']);
    !$isLogged ? $_SESSION['last_error'] = "Вам нужно авторизоваться" : $_SESSION['last_error'] = '';
    return $isLogged;
}


function redirect($url)
{
    header("Location: http://localhost:9090/CoffetTime_gitea/$url.php");
    exit;
}
