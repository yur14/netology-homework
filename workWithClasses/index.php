<?php
include 'class/News.php';
include 'class/Comments.php';
$news[0] = new News(
    '0',
    '26.11.2016',
    'Новость 1',
    '<a href="#">news.com</a>',
    '<p>СМИ опубликовали новость</p>
	<p>Публикации появились</p>
<p>Все публикации основывались </p>
<p>Большинство изданий отредактировали свои сообщения.</p>
');
$news[1] = new News(
    '1',
    '26.11.2016',
    'Новость 2',
    '<a href="#">news.com</a>',
    '<p>СМИ опубликовали новость</p>
	<p>Публикации появились</p>
<p>Все публикации основывались </p>
<p>Большинство изданий отредактировали свои сообщения.</p>
');
$news[2] = new News(
    '2',
    '26.11.2016',
    'Новость 3',
    '<a href="#">news.com</a>',
    '<p>СМИ опубликовали новость</p>
	<p>Публикации появились</p>
<p>Все публикации основывались </p>
<p>Большинство изданий отредактировали свои сообщения.</p>
');
$comments[0][0] = new Comment('26.11.2016', 'Вася', '<p>Круто!</p>');
$comments[1][0] = new Comment('26.11.2016', 'WhiteRabbit001', '<p>Хахаха!</p>');
$comments[1][1] = new Comment('26.11.2016', 'Jason', '<p>Ну вообще...</p>');
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News</title>
    <style>
        table {
            width: 50%;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>
<body>
<a href="index.html"><h3>На главную</h3></a>
<?php $news[0]->showNews($comments) ?>
<?php $news[1]->showNews($comments) ?>
<?php $news[2]->showNews($comments); ?>
</body>
</html>
