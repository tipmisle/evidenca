<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

$query = "SELECT SUM(znesek) AS currentMonth FROM vnosi WHERE MONTH(datum) = MONTH(NOW())";
$result = $conn->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);
echo ' '. $row['currentMonth'] .' € ';

?>