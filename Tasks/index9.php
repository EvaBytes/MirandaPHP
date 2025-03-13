<?php
include('../credentials.php');

echo 'Host: ' . gethostname() . '<br>';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);


    $roomType = $_POST['roomType'] ?? '';
    $roomNumber = $_POST['roomNumber'] ?? '';
    $rate = $_POST['rate'] ?? '';
    $offerPrice = $_POST['offerPrice'] ?? '';
    $status = $_POST['status'] ?? '';

    if ($roomType && $roomNumber && $rate && $offerPrice && $status) {
        $stmt = $mysqli->prepare("INSERT INTO rooms (roomType, roomNumber, rate, offerPrice, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $roomType, $roomNumber, $rate, $offerPrice, $status);

        if ($stmt->execute()) {
            echo "<h2>Habitación creada correctamente:</h2>";

            $newRoomId = $stmt->insert_id;

            $stmt = $mysqli->prepare("SELECT * FROM rooms WHERE id = ?");
            $stmt->bind_param("i", $newRoomId);
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
                echo "Error: Could not find the newly created room.";
            }
        } else {
            echo "Error inserting the room: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required!";
    }
} else {
    ?>
    <h2>Create a new room</h2>
    <form method="POST">
        <label>Room Type:</label><br>
        <select name="roomType" required>
            <option value="">--Select Room Type--</option>
            <option value="Double Bed">Double Bed</option>
            <option value="Single Bed">Single Bed</option>
            <option value="Suite">Suite</option>
            <option value="Double Bed Superior">Double Bed Superior</option>
        </select><br><br>

        <label>Room Number:</label><br>
        <input type="text" name="roomNumber" required><br><br>

        <label>Rate:</label><br>
        <input type="text" name="rate" required><br><br>

        <label>Offer Price:</label><br>
        <input type="text" name="offerPrice" required><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="">--Select Status--</option>
            <option value="Available">Available</option>
            <option value="Booked">Booked</option>
        </select><br><br>

        <button type="submit">Add Room</button>
    </form>
    <?php
}

$mysqli->close();
?>
