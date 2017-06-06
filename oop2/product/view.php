<meta charset="utf-8">
<?php
  require_once "Products.php";

$fruit = new Fruit ('Апельсины', 'кг',80,0);
$kettle = new Kettle ('Чайник Скарлетт','шт',100,10);
$clothes = new Clothes ('Носки женские','пар',60,10);


$fruit->Output(1);
$fruit->Output(5);
$fruit->Output(11);
echo "<hr/>";
$kettle->Output(1);
$kettle->Output(5);
$kettle->Output(11);
echo "<hr/>";
$clothes->Output(1);
$clothes->Output(5);
$clothes->Output(11);
echo "<br/>";

