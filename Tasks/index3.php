#Utilizar el mismo código para importar el archivo JSON pero
esta vez pon una etiqueta <ol></ol> y mostrar cada habitación como un
<li></li> utilizando un bucle de PHP. Mostrar las propiedades Name, Number,
Price y Discount#


<?php
$jsonContent = file_get_contents('../Data/rooms.json');

$roomsArray = json_decode($jsonContent, true);

if ($roomsArray && is_array($roomsArray)) {
    echo '<ol>';
    
    foreach ($roomsArray as $room) {
        echo '<li>';
        echo 'Type: ' . htmlspecialchars($room['roomType'] ?? 'No disponible') . '<br>';
        echo 'Number: ' . htmlspecialchars($room['roomNumber'] ?? 'No disponible') . '<br>';
        echo 'Rate: ' . htmlspecialchars($room['rate'] ?? 'No disponible') . '<br>';
        echo 'Offer Price: ' . htmlspecialchars($room['offerPrice'] ?? 'No disponible') . '<br>';
        echo 'Status: ' . htmlspecialchars($room['status'] ?? 'No disponible') . '<br>';
        
        if (isset($room['guest'])) {
            echo 'Guest Name: ' . htmlspecialchars($room['guest']['fullName'] ?? 'No disponible') . '<br>';
            echo 'Reservation Number: ' . htmlspecialchars($room['guest']['reservationNumber'] ?? 'No disponible') . '<br>';
        }
        
        echo '</li>';
    }
    
    echo '</ol>';
} else {
    echo 'Error loading room data.';
}

?>




# http://localhost:8000/Tasks/index3.php
