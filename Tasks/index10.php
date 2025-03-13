<?php
require_once '../libs/BladeOne.php';

use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';  
$cache = __DIR__ . '/cache';  

$blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);

$rooms = [
    ['roomType' => 'Single Bed', 'roomNumber' => '101', 'rate' => '100', 'offerPrice' => '80', 'status' => 'Available'],
    ['roomType' => 'Double Bed', 'roomNumber' => '102', 'rate' => '150', 'offerPrice' => '130', 'status' => 'Booked'],
];

echo $blade->run('rooms', ['rooms' => $rooms]); 
?>
