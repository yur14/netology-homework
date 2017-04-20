<?php
  error_reporting(E_All);
	$content = file_get_contents( 'http://api.openweathermap.org/data/2.5/weather?id=703845&units=metric&APPID=4a21703d96888519c19042bd7927ece2');
	$response = json_decode($content, true);
	$unit = $response['main'];
//	print_r($unit['temp']);  // температ в градусах
//  echo "<br/>";

  $unit1 = $response['name']; // название города
//  print_r($unit1);
//  echo "<br/>";

  $unit2 = $response['main']; // Влажность
//  print_r($unit2['humidity']);
  //var_dump($unit2);
//  echo "<br/>";

$unitX = $response["weather"][0]; //Картинка
//var_dump($unitX);
//print_r ($unitX["main"]);

  if ($unitX["main"] == "Clouds") {
	    $unitXimage = "<img src='http://www.clipartkid.com/images/652/cartoon-cloud-pictures-cliparts-co-k7EHsN-clipart.jpg'>";
    echo "$unitXimage";
  } elseif ($unitX["main"] == "Rain") {
		$unitXimage = "<img src='https://im0-tub-ua.yandex.net/i?id=4c2a0bacb0c177639249b8291958bcf9-l&n=13'>";
		//echo "$unitXimage";
		} elseif ($unitX["main"] == "Clear") {
			$unitXimage = "<img src='https://thecliparts.com/wp-content/uploads/2016/03/sunshine-free-sun-clipart-sun-images-3.png'>";
			echo "$unitXimage";
			}
		
 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Погода в Кривом Роге</title>
</head>
  <body>
    <h3>Погода в Кривом Роге</h3>
    <style>
      body {font-family: sans-serif;}
        dl {display: table-row;}
    dt, dd {display: table-cell;padding: 5px 10px;}
    </style>

  <dl>
    <dt>Город</dt>
    <dd> <?= $unit1 ?> </dd>
  </dl>

  <dl>
    <dt>Температура</dt>
    <dd> <?php print_r($unit['temp']); ?> °C</dd>
  </dl>

  <dl>
    <dt>Влажность воздуха</dt>
    <dd><?php print_r($unit2['humidity']); ?> %</a> </dd>
  </dl>

  <dl>
    <dt>Дата и время</dt>
    <dd> <?php echo date("d-m-Y H:i:s"); ?> </dd>
  </dl>

  <div id='openweathermap-widget'></div>
                      <script type='text/javascript'>
                      window.myWidgetParam = {
                          id: 15,
                          cityid: 703845,
                          appid: '4a21703d96888519c19042bd7927ece2',
                          units: 'metric',
                          containerid: 'openweathermap-widget',
                      };
                      (function() {
                          var script = document.createElement('script');
                          script.type = 'text/javascript';
                          script.async = true;
                          script.src = 'http://openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js';
                          var s = document.getElementsByTagName('script')[0];
                          s.parentNode.insertBefore(script, s);
                      })();
                    </script>



<body/>
</html>
