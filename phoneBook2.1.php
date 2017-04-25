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
		
		<?php foreach($numbers as $row): ?>
			
<h3>Контакт</h3>	
  <dl>
    <dt>Имя</dt>
    <dd><?php echo $row['firstName'] ?> </dd>
  </dl> 
  
  <dl>
    <dt>Фамилия</dt>
    <dd><?php echo $row['lastName'] ?></dd>
  </dl>
  
  <dl>
    <dt>Адресс</dt>
    <dd><?php echo $row['address'] ?> </dd>
  </dl>
  
  <dl>
    <dt>Номер телефона</dt>
    <dd><?php echo $row['phoneNumber'] ?> </dd>
  </dl>
  
  <?php endforeach; ?>
  
</body>
</html>
