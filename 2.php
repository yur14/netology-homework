<?php
error_reporting(E_ALL);
$x = rand(0,100);
$x1 = 1;
$x2 = 1;
echo '<pre>'."$x".'</pre>';

while ($x1 < $x) {
  $x3 = $x1;
  $x1 += $x2;
  $x2 = $x3;

echo '<pre>';
    if ($x1 > $x) {
      echo "Задуманное число не входит в числовой ряд";
    }
    echo '<pre>';
    if ($x1 = $x) {
      echo "Задуманное число входит в числовой ряд";
    }
}
 
