<?php
$jsonContent = file_get_contents('../Data/rooms.json');

$roomsArray = json_decode($jsonContent, true);

echo '<pre>';
print_r($roomsArray);
echo '</pre>';
?>

# http://localhost:8000/Tasks/index2.php - it works 