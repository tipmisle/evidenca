<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

$query = "SELECT vrsta, SUM(znesek) as cena FROM vnosi GROUP BY vrsta DESC WITH ROLLUP LIMIT 1";
$result = $conn->query($query);

while($row = $result->fetch(PDO::FETCH_ASSOC)){
echo '<span>'. $row['vrsta'] .'</span>';
}

?>