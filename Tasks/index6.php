<!---Acceder la página con un query param
(localhost:8000/index4.php?id=1). Conectar a la base de datos de MySQL
utilizando mysqli. Hacer una consulta para obtener una habitación (con el ID
de GET) y mostrarla abajo utilizando el código de index4.php.-->


<?php
include('../credentials.php');

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    $mysqli = new mysqli($host, $user, $password, $database);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $stmt = $mysqli->prepare("SELECT roomType, roomNumber, rate, offerPrice, status FROM rooms WHERE id = ?");
    
    if (!$stmt) {
        echo "Error preparing the query: " . $mysqli->error;
        exit();
    }

    $stmt->bind_param("i", $roomId);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();

        echo 'Room Type: ' . htmlspecialchars($room['roomType']) . '<br>';
        echo 'Room Number: ' . htmlspecialchars($room['roomNumber']) . '<br>';
        echo 'Rate: ' . htmlspecialchars($room['rate']) . '<br>';
        echo 'Offer Price: ' . htmlspecialchars($room['offerPrice']) . '<br>';
        echo 'Status: ' . htmlspecialchars($room['status']) . '<br>';
    } else {
        echo 'No room found with the ID: ' . htmlspecialchars($roomId);
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "No room ID provided in the URL.";
}
?>
