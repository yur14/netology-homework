<?php
include 'functions.php';
?>

    <!doctype html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8" lang="ru">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Выбор и прохождение теста</title>
        <style>
            body {
                font-family: sans-serif;
            }

            dl {
                display: table-row;
            }

            dt, dd {
                display: table-cell;
                padding: 5px 10px;
            }
        </style>
    </head>

    <body>
    <b>Доступные для прохождения тесты:</b>
    <?php
    $uploadDir = "uploads/";
    $tests = showUploadedTests($uploadDir);
    ?>
    <form method="get">
        <label for="testNumber">Введите номер теста, который хотите пройти:</label>
        <input id="testNumber" name="testNumber" />
        <button type="submit">Отправить</button>
    </form>
    </br>

    <?php

    if (!empty($_GET["testNumber"]) && (!is_numeric($_GET["testNumber"]) || $_GET["testNumber"] <= 0)) {
        http_response_code(400);
        echo 'Номер теста введен в недопустимом формате, попробуйте снова';
        die;
    } else {
        if (!empty($_GET["testNumber"])) {
            if (array_key_exists($_GET["testNumber"], $tests)) {
                $jsonFilePath = $uploadDir . $tests[$_GET["testNumber"]];
                $jsonContent = file_get_contents($jsonFilePath);
                $jsonDecoded = json_decode($jsonContent, true);
                showTest($jsonDecoded);
            } else {
                http_response_code(404);
                echo "Извините, тест с таким номером не найден";
                die;
            }
        }
    }

?>
    </body>
</html>
