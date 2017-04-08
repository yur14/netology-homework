<?php
  error_reporting(E_All);
  $name ="Юрий";
  $age = 23;
  $email = "yurii.simchuk@yahoo.com";
  $city = "Кривой Рог";
  $aboutMe = "Я студент Нетологии";
 ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Юрий - студент Нетологии</title>
  </head>
  <body>
    <h1>Страница пользователя Юра </h1>
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
  <dl>
    <dt> Имя </dt>
    <dd> <?= $name ?> </dd>
  </dl>
  <dl>
    <dt> Возраст </dt>
    <dd> <?= $age ?> </dd>
  </dl>
  <dl>
    <dt> Адрес электронной почты </dt>
    <dd> <a href="#"> <?= $email ?> </a> </dd>
  </dl>
  <dl>
    <dt> Город </dt>
    <dd> <?= $city ?> </dd>
  </dl>
  <dl>
    <dt> О себе </dt>
    <dd> <?= $aboutMe ?> </dd>
  </dl>

</html>
