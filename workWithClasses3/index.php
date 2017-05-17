<?php
require_once 'app/session.php';
require_once 'app/autoload.php';

$obj = new \classes\appliances\Appliances();
$obj1 = new \classes\clothing\Clothing();
$obj2 = new \classes\telephones\Telephones();
$obj3 = new \classes\furniture\Furniture();
$objCart = new \classes\cart\Cart();
if (isset($_GET['id'])) {
    $_GET['vol'] = isset($_GET['vol']) ? $vol : 1;
    $objCart->addProduct($_GET['id'], $_GET['vol']);
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Домашние задание 3.3</title>
</head>
<body>
<p><h4>Пространства имен (namespaces)</h4> - один из способов инкапсуляции элементов. В коде, пространства имен определяются с помощью единственного слова namespace в самом начале Вашего PHP файла. Проблемы совпадения имен снимаются введением пространств имен. PHP константы, классы и функции могут быть сгруппированы в библиотеки пространств имен (namespaced libraries).</p>
<p><h4>Исключения</h4> — это гибкий, расширяемый метод обработки ошибок, человеку, не работавшему с вашим кодом, не нужно будет читать мануал, чтобы понять, как обрабатывать ошибки. Ему достаточно знать, как работают исключения.
С исключениями гораздо проще находить источник ошибок, так как всегда есть стек вызовов (trace).
</p>
<div class="form">
    <p>
        <a href="order.php">Корзина: <?= $_SESSION['cartNumber'] ?></a>
        <p>Общая сумма: <?= $_SESSION['cartPrice'] ?></p>
    </p>
    <div><h2>Электротовары:</h2>
        <?php
        $obj->printProduct();
        ?>
    </div>
    <div><h2>Одежда:</h2>
        <?php
        $obj1->printProduct();
        ?>
    </div>
    <div><h2>Телефоны:</h2>
        <?php
        $obj2->printProduct();
        ?>
    </div>
    <div><h2>Мебель:</h2>
        <?php
        $obj3->printProduct();
        ?>
    </div>
</div>
</body>
</html>
