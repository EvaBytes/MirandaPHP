<?php
$jsonContent = file_get_contents('../Data/rooms.json');

$roomsArray = json_decode($jsonContent, true);

if ($roomsArray && is_array($roomsArray)) {
    echo '<ol>';
    
    foreach ($roomsArray as $room) {
        echo '<li>';
        echo 'Name: ' . htmlspecialchars($room['Name']) . '<br>';
        echo 'Number: ' . htmlspecialchars($room['Number']) . '<br>';
        echo 'Price: $' . htmlspecialchars($room['Price']) . '<br>';
        echo 'Discount: ' . htmlspecialchars($room['Discount']) . '%<br>';
        echo '</li>';
    }
    
    echo '</ol>';
} else {
    echo 'Error al cargar los datos de las habitaciones.';
}
?>
