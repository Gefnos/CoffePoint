<?php
session_start();
require_once 'functions.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create-good'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = (float) $_POST['price'];
        $img_path = $_POST['img_path'];
        createGood($title, $description, $price, $img_path);
    }

    if (isset($_POST['edit-good'])) {
        $id = (int) $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = (float) $_POST['price'];
        $img_path = !empty($_POST['img_path']) ? $_POST['img_path'] : null;
        updateGood($id, $title, $description, $price, $img_path);
    }
}

$goods = getAllGoods();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Товары | Админка</title>
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
        textarea {
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
        <h2>Товары</h2>

        <div class="form-section">
            <h3>Добавить товар</h3>
            <form method="POST">
                <input type="text" name="title" placeholder="Название" required>
                <textarea name="description" placeholder="Описание" required></textarea>
                <input type="number" step="0.01" name="price" placeholder="Цена" required>
                <input type="text" name="img_path" placeholder="Ссылка на изображение">
                <button type="submit" name="create-good">Создать</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Изображение</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($goods as $good): ?>
                    <tr>
                        <td><?= $good['id'] ?></td>
                        <td><?= htmlspecialchars($good['title']) ?></td>
                        <td><?= htmlspecialchars($good['description']) ?></td>
                        <td><?= number_format($good['price'], 2, '.', ' ') ?> ₽</td>
                        <td>
                            <?php if (substr($good['img_path'], 0, 7) === 'assets/'): ?>
                                <img src="../<?= htmlspecialchars($good['img_path']) ?>" alt="изображение"
                                    style="height: 50px;">
                            <?php else: ?>
                                <img src="<?= htmlspecialchars($good['img_path']) ?>" alt="изображение" style="height: 50px;">
                            <?php endif; ?>
                        </td>
                        </td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $good['id'] ?>">
                                <input type="text" name="title" value="<?= htmlspecialchars($good['title']) ?>" required>
                                <textarea name="description"
                                    required><?= htmlspecialchars($good['description']) ?></textarea>
                                <input type="number" step="0.01" name="price" value="<?= $good['price'] ?>" required>
                                <input type="text" name="img_path" value="<?= htmlspecialchars($good['img_path']) ?>"
                                    placeholder="Новая ссылка на изображение">
                                <button type="submit" name="edit-good">Сохранить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>