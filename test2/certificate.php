<?php
include 'functions.php';

header('Content-Type: image/png');
header('Content-Disposition: inline; filename="Certificate.png"');

$name = htmlspecialchars($_POST['usersName']);

imageTextCenter('/assets/certificate.png', '/fonts/font.ttf', 30, $name, 0.5);
