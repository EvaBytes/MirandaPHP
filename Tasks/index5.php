<!---  Conectar a la base de datos de MySQL utilizando mysqli. Hacer
una consulta para obtener las habitaciones y mostrarlas abajo utilizando el
código de index3.php -->


<?php
include('../credentials.php');

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$roomsArray = [
    ['Double Bed', '194', '525', '275', 'Available'],
    ['Suite', '278', '425', '350', 'Available'],
    ['Double Bed Superior', '656', '345', '325', 'Booked'],
    ['Suite', '254', '525', '325', 'Booked'],
    ['Single Bed', '855', '425', '300', 'Available'],
    ['Double Bed Superior', '395', '525', '350', 'Available'],
    ['Double Bed Superior', '398', '345', '325', 'Available'],
    ['Suite', '149', '345', '300', 'Available'],
    ['Single Bed', '147', '475', '300', 'Booked'],
    ['Double Bed Superior', '821', '475', '275', 'Booked']
];

$stmt = $mysqli->prepare("INSERT INTO rooms (roomType, roomNumber, rate, offerPrice, status) VALUES (?, ?, ?, ?, ?)");

if (!$stmt) {
    echo " Error en la preparación de la consulta: " . $mysqli->error;
    exit();
}

$stmt->bind_param("sssss", $roomType, $roomNumber, $rate, $offerPrice, $status);

foreach ($roomsArray as $room) {
    list($roomType, $roomNumber, $rate, $offerPrice, $status) = $room;
    
    if ($stmt->execute()) {
        echo "Added room: $roomNumber<br>";
    } else {
        echo "Error adding room $roomNumber: " . $stmt->error . "<br>";
    }
}

$stmt->close();

$query = "SELECT * FROM rooms";
$result = $mysqli->query($query);

if ($result) {
    echo "<h2>Lista de Habitaciones:</h2><ul>";

    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "Tipo: " . htmlspecialchars($row['roomType']) . "<br>";
        echo "Número: " . htmlspecialchars($row['roomNumber']) . "<br>";
        echo "Tarifa: " . htmlspecialchars($row['rate']) . "<br>";
        echo "Precio de Oferta: " . htmlspecialchars($row['offerPrice']) . "<br>";
        echo "Estado: " . htmlspecialchars($row['status']) . "<br>";
        echo "</li><br>";
    }

    echo "</ul>";
} else {
    echo "Error getting the rooms " . $mysqli->error;
}

$mysqli->close();
$mysqli->close();
?>
