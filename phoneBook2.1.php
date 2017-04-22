<?php
 $fileJson = file_get_contents("phoneBook.json");
$numbers = json_decode( $fileJson, true);
//var_dump($numbers);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Телефонная книга</title>
</head>
  <body>
        <style>
      body {font-family: sans-serif;}
        dl {display: table-row;}
    dt, dd {display: table-cell;padding: 5px 10px;}
    </style>

			<?php foreach($numbers as $osnKeys => $masivs) {
				foreach ($masivs as $innerKeys => $value) {
				//echo "[$osnKeys][$innerKeys] = $value</br>";
				//echo "$value</br>";
				}
			}   ?>
			
<h3>Контакт 1</h3>	
  <dl>
    <dt>Имя</dt>
    <dd><?=$numbers[0]["firstName"]?> </dd>
  </dl> 
  
  <dl>
    <dt>Фамилия</dt>
    <dd><?=$numbers[0]["lastName"]?> </dd>
  </dl>
  
  <dl>
    <dt>Адресс</dt>
    <dd><?=$numbers[0]["address"]?> </dd>
  </dl>
  
  <dl>
    <dt>Номер телефона</dt>
    <dd><?=$numbers[0]["phoneNumber"]?> </dd>
  </dl>
  
  <h3>Контакт 2</h3>	
  <dl>
    <dt>Имя</dt>
    <dd><?=$numbers[1]["firstName"]?> </dd>
  </dl> 
  
  <dl>
    <dt>Фамилия</dt>
    <dd><?=$numbers[1]["lastName"]?> </dd>
  </dl>
  
  <dl>
    <dt>Адресс</dt>
    <dd><?=$numbers[1]["address"]?> </dd>
  </dl>
  
  <dl>
    <dt>Номер телефона</dt>
    <dd><?=$numbers[1]["phoneNumber"]?> </dd>
  </dl>
  
  <h3>Контакт 3</h3>	
  <dl>
    <dt>Имя</dt>
    <dd><?=$numbers[2]["firstName"]?> </dd>
  </dl> 
  
  <dl>
    <dt>Фамилия</dt>
    <dd><?=$numbers[2]["lastName"]?> </dd>
  </dl>
  
  <dl>
    <dt>Адресс</dt>
    <dd><?=$numbers[2]["address"]?> </dd>
  </dl>
  
  <dl>
    <dt>Номер телефона</dt>
    <dd><?=$numbers[2]["phoneNumber"]?> </dd>
  </dl>
		
		
		<h3>Контакт 4</h3>	
  <dl>
    <dt>Имя</dt>
    <dd><?=$numbers[3]["firstName"]?> </dd>
  </dl> 
  
  <dl>
    <dt>Фамилия</dt>
    <dd><?=$numbers[3]["lastName"]?> </dd>
  </dl>
  
  <dl>
    <dt>Адресс</dt>
    <dd><?=$numbers[3]["address"]?> </dd>
  </dl>
  
  <dl>
    <dt>Номер телефона</dt>
    <dd><?=$numbers[3]["phoneNumber"]?> </dd>
  </dl>
  
  <h3>Контакт 5</h3>	
  <dl>
    <dt>Имя</dt>
    <dd><?=$numbers[4]["firstName"]?> </dd>
  </dl> 
  
  <dl>
    <dt>Фамилия</dt>
    <dd><?=$numbers[4]["lastName"]?> </dd>
  </dl>
  
  <dl>
    <dt>Адресс</dt>
    <dd><?=$numbers[4]["address"]?> </dd>
  </dl>
  
  <dl>
    <dt>Номер телефона</dt>
    <dd><?=$numbers[4]["phoneNumber"]?> </dd>
  </dl>
  
</body>
</html>
