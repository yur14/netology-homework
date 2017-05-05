<!DOCTYPE html>
<html>
<?php
error_reporting(E_ALL);
?>
<head>
  <meta charset="utf-8">
  <title>Животные</title>
</head>
<body>

<h1>Животные</h1>

<?php
$Eurasia_animals = array("Giant Panda", "Gharial crocodile", "Mouflon");
$Africa_animals = array("African Elephant", "Arabian Camel", "Assassin Bug");
$North_A_animals = array("Agouti", "Alaskan Malamute");
$South_A_animals = array("Black Caiman", "Capybara", "Common Iguana", "Dogfish Shark");
$Australia_animals = array("Black Swan", "Dingo", "Frilled Lizard", "Kangaroo", "Minke Whale");
$Antarctica_animals = array("Antarctic Krill", "Arctic Tern");

$All_animals = array ("Eurasia" => $Eurasia_animals,
                      "Africa" => $Africa_animals,
                      "NorthAmerica" => $North_A_animals,
                      "SouthAmerica" => $South_A_animals,
                      "Australia" => $Australia_animals,
                      "Antarctica" => $Antarctica_animals
                     );


//перемешать слова в массиве
function mixer ($arr_mx,$key)
{
//преобразуем в строку
    $im_str = implode(' ', $arr_mx[$key]);
//преобразуем обратно в массив - разделитель пробел, т.е. разделяем массив по одному слову
    $ex_str = explode(' ', $im_str);
//перемешиваем массив
    $x=shuffle($ex_str);
//возвращаем значение
    return $ex_str;
}

//достать случайное слово из массива
function one_word ($arr_ow)
{
//получаем случайный ключ массива
$k=array_rand($arr_ow, 1);
//достаем слово по ключу
$word = $arr_ow[$k];
//возвращаем значение
return $word;
}

//создание общего нового массива в котором только названия животных состоящих из 2-х слов
foreach($All_animals as $key => $vol)
{
   for($i=0; $i < count($All_animals[$key]); $i++)
   {
    //++поиск пробела - все животные состоящие из 2-х слов
    $space = (strrpos($All_animals[$key][$i], ' '));
        if ($space === false) {}
        else
             {
    //++запись в новый массив
    $tmp[$key][$i]=$All_animals[$key][$i];
             }
    }
}

//работаем с новым массивом
foreach($tmp as $key => $vol)
{

//выводим континент
echo "<h2>".$key."</h2>";

//в $res уже перемешанные значения - осталось их сложить по словам с другим массивом
$res[$key]=mixer($tmp,$key);
//достаем случайный ключ из массива $tmp
$rnd_key=array_rand($tmp);

for($i=0; $i < count($res[$key]); $i++)
    {
//получаем случайное слово из случайного массива
    $w1=one_word(mixer($tmp,$rnd_key));
//сложение элементов массива
    $res1[$key][$i]=$res[$key][$i]." ".$w1;
//выводим на экран
    echo $res1[$key][$i];
//не рисовать запятую в конце строки
     if ($i<count($res[$key])-1)
        {
         echo ", ";
        }
     }
}

?>

</body>
</html>
