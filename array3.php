<?php
$animals = [
    "Africa"     => ["Philantomba monticola", "Lemuridae", "Panthera pardus", "Rhinocerotidae", "Giraffa camelopardalis"],
    "Australia"  => ["Sarcophilus laniarius", "Canis dingo", "Vombatidae", "Dacelo gaudichaud", "Ornithorhynchus anatinus"],
    "Antarctica" => ["Phocidae", "Balaenoptera musculus", "Oceanodroma leucorhoa", "Stercorarius skua", "Spheniscidae"]
           ];

$newAnimals     = [];
$firstWord      = [];
$secondWord     = [];
$fantasyAnimals = [];
/////////////////////////////////////////////////
foreach ($animals as $continent => $value) {
    if($continent == "Africa") {
        foreach($value as $africanAnimals) {
            $start = strpos($africanAnimals, ' ');
            $cut = substr($africanAnimals, $start);
            $africanAnimals = str_replace($cut, '', $africanAnimals);
            if($africanAnimals == ''){
                continue;
            }
            $firstWordAfrica[] = $africanAnimals;
        }
    }
    if($continent == "Australia") {
        foreach($value as $australianAnimals) {
            $start = strpos($australianAnimals, ' ');
            $cut = substr($australianAnimals, $start);
            $australianAnimals = str_replace($cut, '', $australianAnimals);
            if($australianAnimals == ''){
                continue;
            }
            $firstWordAustralia[] = $australianAnimals;
        }
    }
    if($continent == "Antarctica") {
        foreach($value as $antarcticanAnimals) {
            $start = strpos($antarcticanAnimals, ' ');
            $cut = substr($antarcticanAnimals, $start);
            $antarcticanAnimals = str_replace($cut, '', $antarcticanAnimals);
            if($antarcticanAnimals == ''){
                continue;
            }
            $firstWordAntarctica[] = $antarcticanAnimals;
        }
    }
    foreach ($value as $animalsName) {
        if(strpos($animalsName, ' ')) {
            $newAnimals[] = $animalsName;
        }
    }
}
//////////////////////////////////////////////////
foreach ($newAnimals as $string) {
    $start = strpos($string, ' ');
    $cut = substr($string, $start);
    $string = str_replace($cut, '', $string);
    $firstWord[] = $string;
    $secondWord[] = $cut;
}
$shuffle = shuffle($secondWord);
$animals["Africa"]     = [];
$animals["Australia"]  = [];
$animals["Antarctica"] = [];

for ($i = 0; $i<count($firstWord); $i++) {
    $fantasyAnimals[] = "$firstWord[$i] $secondWord[$i]";
    if (isset($firstWordAfrica[$i])) {
        if ($firstWord[$i] === $firstWordAfrica[$i] or $firstWord[$i] === $firstWordAfrica[$i] or $firstWord[$i] === $firstWordAfrica[$i]) {
            $animals["Africa"][$i] = $firstWord[$i] . $secondWord[$i];
        }
    }
    if (isset($firstWordAustralia[$i])) {
        if ($firstWord[$i+count($animals)] === $firstWordAustralia[$i] or $firstWord[$i] === $firstWordAustralia[$i] or $firstWord[$i] === $firstWordAustralia[$i] or $firstWord[$i] === $firstWordAustralia[$i]) {
            $animals["Australia"][$i] = $firstWord[$i+count($animals)] . $secondWord[$i];
        }
    }
}

foreach($animals as $value) {
    foreach($value as $animalName) {
        $animalNamed[] = $animalName;
    }
}

for ($i = 0; $i<count($firstWord); $i++) {
    if (isset($firstWordAntarctica[$i])) {
        if ($firstWord[$i + count($animalNamed)] === $firstWordAntarctica[$i] or $firstWord[$i] === $firstWordAntarctica[$i] or $firstWord[$i] === $firstWordAntarctica[$i]) {
            $animals["Antarctica"][$i] = $firstWord[$i + count($animalNamed)] . $secondWord[$i];
        }
    }
}
//////////////////////////////////////////////////
echo "<h1>Животные:</h1>";
foreach ($animals as $key => $newContinent) {
    echo "<h2>$key</h2>";
    $result = implode(", ", $newContinent);
    echo $result;
}
