<!-- views/rooms.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
</head>
<body>
    <h2>Lista de Habitaciones</h2>

    <ul>
        @foreach ($rooms as $room)
            <li>
                <strong>Type:</strong> {{ $room['roomType'] ?? 'Not available' }}<br>
                <strong>Number:</strong> {{ $room['roomNumber'] ?? 'Not available' }}<br>
                <strong>Rate:</strong> {{ $room['rate'] ?? 'Not available' }}<br>
                <strong>Offer Price:</strong> {{ $room['offerPrice'] ?? 'Not available' }}<br>
                <strong>Status:</strong> {{ $room['status'] ?? 'Not available' }}<br>
            </li><br>
        @endforeach
    </ul>
</body>
</html>
