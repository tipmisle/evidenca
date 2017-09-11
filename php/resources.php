<?php 
header('Content-Type: application/json');
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

$query = "SELECT vrsta, SUM(znesek) as cena FROM vnosi GROUP BY vrsta WITH ROLLUP LIMIT 4";
$result = $conn->query($query);

$resultJson = $result->fetchAll(PDO::FETCH_ASSOC);

print json_encode($resultJson);

?>