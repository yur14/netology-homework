<?php
error_reporting(E_ALL);
$allAnimals = array(
        "Eurasia"       => array("Red deer", "Pond turtle", "Indian Rhinoceros", "Praying Mantis", "Bison", "Anser"),
        "Africa"        => array("Fennec Fox", "Forest Giraffe", "Golden Eagle", "Hedgehog", "Redbilled Oxpecker"),
        "North America" => array("Bighorn Sheep", "Blue Heron", "Bobcat", "Brown Pelican", "Canada Goose", "Crocodile"),
        "South America" => array("Hare", "Hermit Crab", "Lowland Tapir", "Paint Horse", "Plain Xenops"),
        "Australia"     => array("Red Kangaroo", "Sugar Glider", "Ringtail Possum", "Tasmanian Tiger", "Wombat"),
        "Antarctica"    => array("Octopus", "Penguin", "Sea Star", "Spectacled Porpoise", "Squid", "Weddell Seal"));
//разделяем массив на массивы первых и вторых слов
foreach ($allAnimals as $continents => $animals) {
    foreach ($animals as $key => $val) {
        if (strpos ( $val, ' ')) {
            $firstWords["$continents"][$key] =  substr($val, 0 , strpos ( $val, ' '));
            $secondWords["$continents"][$key] = trim(substr($val, (strpos ($val, ' '))));
        }
    }
}
//создаем одномерный массив вторых слов
$onlySecondsWords = array();
foreach($secondWords as $arr1) {
    $onlySecondsWords = array_merge($onlySecondsWords, array_values($arr1));
}
//перемешиваем массив первых слов
foreach ($firstWords as $key => $val) {
    shuffle($firstWords[$key]);
}
//перемешиваем массив вторых слов
shuffle($onlySecondsWords);
//выводим на экран
$q=0;
foreach ($firstWords as $key => $val) {
    echo "<h2>$key</h2>";
    for($i = 0; $i<count($val); $i++) {
        echo $val[$i]." ";
        echo $onlySecondsWords[$q];
        if ($i<count($val)-1) echo ", ";
        $q++;
    }
}

