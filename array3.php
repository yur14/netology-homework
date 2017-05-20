<?php
$worldAnimals = [
        'Europe' => ['Panthera tigris altaica', 'Pusa sibirica', 'Meles meles', 'Ursus maritimus', 'Ursus meles maritimus sibirica'],
        'North America' => ['Ovis nivicola', 'Lynx rufus', 'Rangifer tarandus', 'Canis latrans', 'Grizzly bear', 'Grizzly rufus nivicola'],
        'Africa' => ['Rhinocerotidae', 'Loxodonta africana', 'Pardus', 'Lemuridae', 'Lemuridae pardus africana'],
        'South America' => ['Polar bears', 'Gray volf', 'Black bear', 'Cougar', 'Moose', 'Gray moose bear']
               ];
$animalFirst = [];
$animalSecond = [];
$animal = [];
foreach ($worldAnimals as $keys => $values){
    foreach($values as $key => $val){
        // Разбиваем входные данные на слова, если 2 то true
        $quant = count(explode(" ", $val)) == 2;
        // Если входные данные равняются 2 то разбиваем данные по словам и помещаем в массив слов
        if($quant){
            $it = explode(" ", $val);
            foreach($it as $k => $v){
                $animal[] = $v;
                // Если ключ = 0, то это первое слово, помещаем в массив с первыми словами, иначе в массив вторых слов.
                if($k == 0){
                    $animalFirst[] = $v;
                    } else {
                    $animalSecond[] = $v;
                }
            }
        }
    }
}
// Перемешиваем массивы данных первых и вторых слов.
shuffle($animalFirst);
shuffle($animalSecond);
$countAnimalFirst = count($animalFirst);
$length = count($animal) - 1;
function rnd($arr){
    return rand(0,$arr - 1);
}
$parentCount=[];
// Создаем массив с ключами названиями регионов
foreach($worldAnimals as $key => $val){
    $parentCount[$key] = "";
}
for($i = 0; $i < count($animalFirst); $i++){
    foreach($worldAnimals as $key => $val){
        foreach($val as $k => $v){
            $quant = count(explode(" ", $v)) == 2; // Проверяем, что бы название состояло из 2х слов
            $pos = strpos($v, $animalFirst[$i]) === 0; // Проверяем что бы слово было первым
            if($quant && $pos){
                $parentCount[$key][] = $animalFirst[$i] . " " . $animalSecond[$i];
            }
        }
    }
}
// Выводим полученный массив выдуманных животных с изначальным континентом.
foreach($parentCount as $key => $val){
    echo "<h2> $key:</h2> <ol>";
    foreach($val as $k => $v){
        if($i < count($v)-1){
            echo "<li> $v,</li>";
        }
    }
        echo "</ol>";
        echo implode(", ", $val), ".";
}
