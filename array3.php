<?php
$animals = [
    "Africa"     => ["Philantomba monticola", "Lemuridae", "Panthera pardus"],
    "Australia"  => ["Sarcophilus laniarius", "Canis dingo", "Vombatidae"],
    "Antarctica" => ["Phocidae", "Balaenoptera musculus", "Oceanodroma leucorhoa"]
           ];
foreach ($animals as $k => $v){
    $animalsTwoWords[$k] = preg_grep("~\s{1}~",$v);
}
foreach ($animalsTwoWords as $key => $value) {
    foreach($value as $word) {
        $kusok = explode(" ",$word);
        $kusok1[] = $kusok[0]. "_" .$key;
        $kusok2[]= $kusok[1];
    }
}
shuffle($kusok2);
shuffle($kusok1);
$count = count($kusok1);

for ($i=0; $i<$count; $i++) {
    $result = explode("_",$kusok1[$i]);
    echo "<h2>" . $result[1] ."</h2>" . "<p>" . $result[0] . " ". $kusok2[$i] . "</p>";
}

