<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

//SQL stavek, ki prikaže podatke iz baze
$query = "SELECT * FROM evidenca.vnosi";
$result = $conn->query($query);

//while zanka za prikaz podatkov
while($row = $result->fetch(PDO::FETCH_ASSOC)){
	echo '<tr>
		<td class="text-center">'. $row['vrsta'] .'</td>
		<td class="text-center">'. $row['datum'] .'</td>
		<td class="text-center">'. $row['znesek'] .'€</td>
		<td class="text-center"><a class="odstrani" id="'. $row['id']  .'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
	  </tr>';
}
?>
