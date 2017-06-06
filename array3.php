<?php
	error_reporting(E_ALL);
    $animals = [
      "Africa" => ["African elephant", "Gavialis gangeticus"],
      "Antarctica" => ["Stercorarius skua", "Aptenodytes patagonicus"],
      "Australia" => ["Dendrolagus", "Cereopsis novaehollandiae"],
      "Eurasia" => ["Ailuropoda melanoleuca", "Rangifer tarandus"],
      "North America" => ["Taxidea taxus", "Crotalinae"],
      "South America" => ["Ensifera ensifera", "Rhinoderma darwinii"]
    ];
    $two_words_names = [];
    
    foreach ($animals as $animals_list) {
      foreach ($animals_list as $animal_name) {
        if (str_word_count($animal_name) == 2) {
          array_push($two_words_names, $animal_name);
        }
      }
    }
   
    $first_words = [];
    $second_words = [];
    foreach ($two_words_names as $string) {
      $words = explode(" ", $string);
      array_push($first_words, $words[0]);
      array_push($second_words, $words[1]);
    }
    shuffle($first_words);
    shuffle($second_words);
    $fantasy_names = [];
    for ($i=0; $i < count($two_words_names); $i++) {
      array_push($fantasy_names, $first_words[$i]." ".$second_words[$i]);
    }
    
    $fantasy_animals = [
      "Africa" => [],
      "Antarctica" => [],
      "Australia" => [],
      "Eurasia" => [],
      "North America" => [],
      "South America" => []
    ];
    foreach ($fantasy_names as $fantasy_name) {
      $fantasy_first_word = explode(" ", $fantasy_name)[0];
      foreach ($animals as $continent => $animals_list) {
        foreach ($animals_list as $animal_name) {
          $default_first_word = explode(" ", $animal_name)[0];
          if ($fantasy_first_word === $default_first_word) {
            array_push($fantasy_animals[$continent], $fantasy_name);
          }
        }
      }
    }
    
    foreach ($fantasy_animals as $continent => $animals_list) {
      echo "<h2>{$continent}</h2>";
      echo implode(", ", $animals_list)."<br>";
    }
 
