<!-- Utilizar el código de index5.php para mostrar todas las
habitaciones, pero incluir un formulario (sin method y sin action) para buscar
también. Utilizar un if para ver si has buscado y hacer una consulta diferente
para obtener las habitaciones WHERE name LIKE <search> -->

<?php
include ('../credentials.php');

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$searchTerm = $_GET['search'] ?? '';

echo '<form>';
echo '<input type="text" name="search" placeholder="Search by Room Type..." value="' . htmlspecialchars($searchTerm) . '">';
echo '<button type="submit">Search</button>';
echo '</form>';

if (!empty($searchTerm)) {
    $stmt = $mysqli->prepare("SELECT * FROM rooms WHERE roomType LIKE ?");
    $likeSearchTerm = '%' . $searchTerm . '%';
    $stmt->bind_param('s', $likeSearchTerm);
} else {
    $stmt = $mysqli->prepare("SELECT * FROM rooms");
}

if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Lista de Habitaciones:</h2><ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "Type: " . htmlspecialchars($row['roomType']) . "<br>";
            echo "Number: " . htmlspecialchars($row['roomNumber']) . "<br>";
            echo "Rate: " . htmlspecialchars($row['rate']) . "<br>";
            echo "Offer Price: " . htmlspecialchars($row['offerPrice']) . "<br>";
            echo "Status: " . htmlspecialchars($row['status']) . "<br>";
            echo "</li><br>";
        }
        echo "</ul>";
    } else {
        echo "There are no rooms available for the search term: " . htmlspecialchars($searchTerm);
    }
} else {
    echo "Error executing the query: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>

<!-- http://localhost:8000/Tasks/index7.php?search=suite-->