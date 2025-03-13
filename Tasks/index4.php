<?php

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    $jsonContent = file_get_contents('../Data/rooms.json');
    $roomsArray = json_decode($jsonContent, true);

    if ($roomsArray && is_array($roomsArray)){
        $found = false;
        foreach ($roomsArray as $room){
            if (isset($room['id']) && $room['id'] == $roomId) {
                echo 'Room Type: ' . htmlspecialchars($room['roomType'] ) . '<br>';
                echo 'Room Number: ' . htmlspecialchars($room['roomNumber'] ) . '<br>';
                echo 'Rate: ' . htmlspecialchars($room['rate'] ) . '<br>';
                echo 'Offer Price: ' . htmlspecialchars($room['offerPrice'] ) . '<br>';
                $found = true;
                break;
            }
        }
    
        if (!$found) {
            echo 'No room found with the ID: ' . htmlspecialchars($roomId);
        }
    } else {    
        echo 'Error loading room data.';
    }
}
?>

<!-- http://localhost:8000/Tasks/index4.php?id=1 -->