<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>CoffePoint | Авторизация</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="css/login.css" />
</head>

<body>
	<video autoplay muted loop id="bgVideo">
		<source src="img/coffee_bean1.mp4" type="video/mp4" />
	</video>

	<div class="container" id="authBox">
		<div class="card">
			<div class="form login">
				<h2>Авторизация</h2>
				<a href="index.php">На главную</a>
				<input type="email" placeholder="Логин" required />
				<input type="password" placeholder="Пароль" required />
				<div class="options">
					<label><input type="checkbox" /> Запомнить</label>
					<a href="#">Забыли пароль?</a>
				</div>
				<button>Войти</button>
				<div class="toggle">
					Нет аккаунта? <span onclick="toggleForm()">Регистрация</span>
				</div>
			</div>

			<div class="form signup">
				<h2>Создать аккаунт</h2>
				<a href="index.php">На главную</a>
				<input type="text" placeholder="Логин" required />
				<input type="email" placeholder="Почта" required />
				<input type="number" placeholder="Номер телефона" required />
				<input type="password" placeholder="Пароль" required />
				<button>Зарегистрироваться</button>
				<div class="toggle">
					Уже есть аккаунт? <span onclick="toggleForm()">Войти</span>
				</div>
			</div>
		</div>
	</div>

	<script src="js/login-animation.js"></script>
</body>

</html>