<?php
session_start();
require_once "autoload.php";
require_once "config.php";
$db = new DataBase();
$db->connectToDB();
$auth = new Authorization($db);
$auth->checkLogin();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Логин</title>
</head>
<body>
<h1>Авторизируйтесь, чтобы продолжить</h1>
<hr/>
<?php if(isset($_SESSION['error_login'])):?>
<h2><?php echo $_SESSION['error_login'] ?></h2>
<?php endif; ?>
<form method="post">
    <label for="username">Имя пользователя: </label>
    <input name="username">
    <label for="password">Пароль: </label>
    <input name="password" type="password">
    <button type="submit">Войти</button>
</form>
<hr/>
<a href="reg.php">Регистрация</a>
</body>
</html>
