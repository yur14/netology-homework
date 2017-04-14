
<?php
error_reporting(E_ALL);
// 1.Составляем масив
	$animals = array(
		"Africa"        => array('Jyraff','Gorilla'),
		"Antarctica"    => array('Aptenodytes forsteri','Aptenodytes patagonica'),
		"Europe"        => array('Bos primigenius','Wolverine'),
		"Asia"          => array('Ailuropoda melanoleuca','Bengal Tiger'),
		"North America" => array('Haliaeetus leucocephalus','Gray Wolf'),
		"South America" => array('Panthera onca','Anaconda'),
		"Australia"     => array('Kangaroo','Koala bear')
			);

		//	2.Создаем пустой масив и вставляем в него назван из 2 слов
$result = [];
foreach ($animals as $continent) {
	$result = array_merge($result, array_filter($continent, function($animals){
		return count(explode(' ', $animals))===2;
	}));
}
print_r($result);
echo "<br/>";
// 3. Перемешиваем названия животных
$animals1 = array_merge($result);
$names = array_map(function($a){return explode(' ', $a)[0];}, $animals1);
$types = array_map(function($a){return explode(' ', $a)[1];}, $animals1);
shuffle($names);
shuffle($types);

$random_result=array();
for($i=0; $i< sizeof($animals1); $i++) {
    array_push($random_result, $names[$i]." ".$types[$i]);
}
print_r($random_result);
// Дополнительное задание
foreach($animals as $country => $cts) {
	echo "<h2>{$country}</h2>";
	$first_city = true;
	foreach($cts as $key => $city) {
		if($first_city === true) {
			$first_city = false;
		}
		else {
			echo ", ";
		}
		echo $city;
	}
}

?>
