<?php
$path = 'visits.log';
$file  = fopen($path, 'r');
$count = fgets($file);
fclose($file);

echo "Odsłon: $count";

if (!isset($_COOKIE['visited'])) {
    $count += 1;
    $file = fopen($path, 'w');
    fwrite($file, $count);
    fclose($file);
    setcookie('visited', 'true', time() + 24*60*60, '/');
}