<?php
function pdo(): PDO // Делаем глобально доступным подключение в БД
{
    static $pdo;
    if (!$pdo) {
        $config = include __DIR__ . '/config.php';
        // Подключение к БД
        $dsn = 'mysql:dbname=' . $config['db_name'] . ';host=' . $config['db_host'] . ";charset=utf8mb4";
        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $pdo;
}

