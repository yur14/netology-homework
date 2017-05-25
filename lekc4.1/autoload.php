<?php
$dir = 'classes';
function autoloader($class) {
    include __DIR__.'/classes/' . $class ;
}
$files = scandir($dir);
foreach ($files as $key => $value) {
    if ($value !== '.' and $value !== '..'){
    autoloader($value);
    }
}
