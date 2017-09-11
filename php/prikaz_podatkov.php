<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

//SQL stavek, ki prikaže podatke iz baze
$query = "SELECT * FROM vnosi WHERE MONTH(datum) = MONTH(NOW())";
$result = $conn->query($query);

//while zanka za prikaz podatkov
while($row = $result->fetch(PDO::FETCH_ASSOC)){
	echo '<tr id="'. $row['id'] .'">
		<td class="text-center">'. $row['vrsta'] .'</td>
		<td class="text-center">'. $row['datum'] .'</td>
		<td class="text-center">'. $row['znesek'] .'€</td>
		<td class="text-center">'. $row['opis'] .'</td>
		<td class="text-center"><a id="'. $row['id'] .'" class="odstrani"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
	  </tr>';
}
?>