<?php
session_start();
require_once "autoload.php";
require_once "config.php";
$db = new DataBase();
$db->connectToDB();
$auth = new Authorization($db);
$auth->signUp();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
<h1>Регистрация новой учетной записи</h1>
<hr/>
<?php if(isset($_SESSION['error_reg'])):?>
    <h2><?php echo $_SESSION['error_reg'] ?></h2>
<?php endif; ?>
<form method="post">
    <label for="username">Имя пользователя: </label>
    <input name="username">
    <label for="password">Пароль: </label>
    <input name="password" type="password">
    <button type="submit">Войти</button>
</form>
<hr/>

<a href="login.php">Перейти на страницу авторизации</a>
</body>
</html>
