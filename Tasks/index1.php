<!--Crear un array en PHP conteniendo 3 habitaciones (cada una es
un array asociativo). Cada habitación tiene 5 propiedades: ID, Name,
Number, Price, Discount. Muestra el array entero dentro de una etiqueta pre.-->

<?php

$rooms = [
    [
        'ID' => 1,
        'Name' => 'Double Bed"',
        'Number' => '101',
        'Price' => '500$',
        'Discount' => '450$'
    ],
    [
        'ID' => 2,
        'Name' => 'Suite',
        'Number' => '102',
        'Price' => '300$',
        'Discount' => '250$'
    ],
    [
        'ID' => 3,
        'Name' => 'Single Bed',
        'Number' => '103',
        'Price' => '200$',
        'Discount' => '180$'
    ]
];

echo '<pre>';
print_r($rooms);
echo '</pre>';

?>
