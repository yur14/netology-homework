<?php
    session_start();
//    error_reporting(E_ALL);
    require_once "autoload.php";
    require_once "config.php";
    $db = new DataBase();
    $db->connectToDB();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Работа с таблицами</title>
        <style>
    table {
        border-spacing: 0;
        border-collapse: collapse;
    }
    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }
    table th {
        background: #eee;
    }
        </style>
    </head>
<body>
<center>
<h1>Работа с таблицами</h1>
    <?php $db->actions(); ?>
</center>
</body>
</html>
