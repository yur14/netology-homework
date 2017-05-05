<?php
require_once __DIR__ . '/ClassNews.php';
$news = new NewsClass();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lesson 3.1. Classes and objects</title>
</head>
<body>
<h1>Главная</h1>
<p>
    <a href="http://webnotes.by/docs/php/inkapsulyaciya-v-php">Инкапсуляция</a> - это свойство системы в ООП, группировать свойства и методы
    над одним объектом в одном не доступном для обычного пользователя месте(файле).
    Доступ к данным должен осуществляться через специальные методы доступа (access methods)
    – «геттеры» (методы получения данных, Get) и «сеттеры» (методы установки данных, Set).
    К плюсам объектов можно отнести удобства работы с кодом, рефакторинг,
    чтение при больших объемах кода, повышение безопасноти. К минусам отнесу только
    то что ООП надо применять по назначению.
</p>
<a href="index.php?id=0">Первая новость</a>
<a href="index.php?id=1">Вторая новость</a>
<a href="index.php?id=2">Третья новость</a>
<h2><?php echo $news->getTitle(); ?></h2>
<h3><?php echo $news->getText(); ?></h3>
<h4><?php echo $news->getComment(); ?></h4>
</body>
</html>