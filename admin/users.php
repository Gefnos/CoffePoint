<?php
session_start();
require_once 'functions.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create-user'])) {
        $login = $_POST['login'];
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $role = (int) $_POST['role'];
        createUser($login, $firstname, $surname, $email, $phone, $password, $role);
    }

    if (isset($_POST['edit-user'])) {
        $id = (int) $_POST['id'];
        $login = $_POST['login'];
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $role = (int) $_POST['role'];
        $password = !empty($_POST['password']) ? $_POST['password'] : null;
        updateUser($id, $login, $firstname, $surname, $email, $phone, $role, $password);
    }
}

$users = getAllUsers();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Пользователи | Админка</title>
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

        .form-section {
            margin-bottom: 2rem;
            padding: 1rem;
            background-color: #f5f0e6;
            border-radius: 5px;
        }

        input,
        select {
            padding: 0.5rem;
            margin: 0.3rem 0;
            width: 100%;
        }

        button {
            padding: 0.5rem 1rem;
            background-color: #6d4c41;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 0.5rem;
        }

        button:hover {
            background-color: #3e2723;
        }
    </style>
</head>

<body>
    <?php include '../templates/admin_header.php'; ?>

    <div class="admin-content">
        <h2>Пользователи</h2>

        <div class="form-section">
            <h3>Добавить сотрудника</h3>
            <form method="POST">
                <input type="text" name="login" placeholder="Логин" required>
                <input type="text" name="firstname" placeholder="Имя" required>
                <input type="text" name="surname" placeholder="Фамилия" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="phone" placeholder="Телефон">
                <input type="password" name="password" placeholder="Пароль" required>
                <select name="role">
                    <option value="0">Клиент</option>
                    <option value="1" selected>Админ</option>
                </select>
                <button type="submit" name="create-user">Создать</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Роль</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['login']) ?></td>
                        <td><?= htmlspecialchars($user['firstname']) ?></td>
                        <td><?= htmlspecialchars($user['surname']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['phone']) ?></td>
                        <td><?= $user['role'] == 1 ? 'Админ' : 'Клиент' ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <input type="text" name="login" value="<?= htmlspecialchars($user['login']) ?>" required>
                                <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>"
                                    required>
                                <input type="text" name="surname" value="<?= htmlspecialchars($user['surname']) ?>"
                                    required>
                                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                                <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                                <select name="role">
                                    <option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>Клиент</option>
                                    <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Админ</option>
                                </select>
                                <input type="password" name="password"
                                    placeholder="Новый пароль (оставьте пустым, чтобы не менять)">
                                <button type="submit" name="edit-user">Сохранить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>