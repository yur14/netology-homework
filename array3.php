<?php
error_reporting(E_ALL);

$zivotniye = array(

    "Africa"        => array('Jyraff pyatnistiy','Gorilla'),

    "Antarctica"    => array('Aptenodytes forsteri'),

    "Europe"        => array('Bos primigenius','Wolverine'),

    "Asia"          => array('Ailuropoda melanoleuca','Bengal Tiger'),

    "North America" => array('Haliaeetus leucocephalus','Gray Wolf'),

    "South America" => array('Panthera onca','Anaconda'),

    "Australia"     => array('Kangaroo','Koala bear')
);
 
 var_dump($zivotniye); 

	// Создаем массив, куда мы сложим животных из двух слов
$animals2 = [];

foreach ($zivotniye as $animals) {

    foreach ($animals as $key => $animal) {

        $count = substr_count($animal, ' ');

        if ($count === 1) {

            array_push($animals2, $animal);
        }
    }
}
	
// Создаем массив, куда мы сложим выдуманных животных
$fantasyAnimals = [];

while (count($animals2) !== 0) {

     if (count($animals2) === 1) {

        array_push($fantasyAnimals, $animals2[0]);

        break;

    } else {
        $first = 0;
        $rand = rand(1, count($animals2) - 1);
        $firstElem = $animals2[$first];
        $randElem = $animals2[$rand];
        
        $fantasyFirst = substr($firstElem, 0, strpos($firstElem, ' ')) . ' '

            . substr($randElem, strpos($randElem, ' '));

        $fantasySecond = substr($randElem, 0, strpos($randElem, ' ')) . ' '

            . substr($firstElem, strpos($firstElem, ' '));

        array_push($fantasyAnimals, $fantasyFirst, $fantasySecond);

        unset($animals2[$first], $animals2[$rand]);

        $animals2 = array_values($animals2);
    }
}

$animalsHome = [];

foreach ($fantasyAnimals as $elem) {

    $words1 = explode(' ', $elem);

    foreach ($zivotniye as $key => $animal) {

        foreach ($animal as $value) {

            $words2 = explode(' ', $value);

            if ($words1[0] === $words2[0]) {

                $animalsHome[$key][] = $elem;
            }
        }
    }
}
	// Сортируем массив $animalsHome на основе ключей массива $zivotniye
foreach ($zivotniye as $key => $item) $continents[] = $key;
foreach ($animalsHome as $key => $animals) $arraysOfAnimals[$key] = $animals;
$continents = array_flip($continents);
$animalsHome = array_merge($continents, $arraysOfAnimals);

function foo($array) {

    foreach ($array as $key => $animals) {

        echo "<div class=\"container\">";

        echo "<h4>{$key}</h4>";

        $anim = implode(",<br>", $animals);

        echo "<p>{$anim}</p>";

        echo "</div>";
    }
}

?>

<!DOCTYPE html>
<html>

	<head>
	<title>Животные</title>
   </head>

<body>
		<h1>Животные в перемешку</h1>
		<div><?php foo($animalsHome); ?></div>
</body>
</html>
