<?php 
header('Content-Type: application/json');
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

$query = "SELECT SUM(znesek) AS znesek, MONTH(datum) AS mesec FROM vnosi GROUP BY MONTH(datum) ASC LIMIT 5";
$result = $conn->query($query);

$resultJson = $result->fetchAll(PDO::FETCH_ASSOC);

print json_encode($resultJson);

?>