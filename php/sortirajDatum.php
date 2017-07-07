<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

$status = $_POST['status'];

if ($status == 1) {
	$query = "SELECT * FROM vnosi WHERE MONTH(datum) = MONTH(NOW()) ORDER BY datum ASC";
	$result = $conn->query($query);
} else {
	$query = "SELECT * FROM vnosi WHERE MONTH(datum) = MONTH(NOW()) ORDER BY datum DESC";
	$result = $conn->query($query);
}



while($row = $result->fetch(PDO::FETCH_ASSOC)){
echo '<tr>
		<td class="text-center">'. $row['vrsta'] .'</td>
		<td class="text-center">'. $row['datum'] .'</td>
		<td class="text-center">'. $row['znesek'] .'€</td>
		<td class="text-center"><a id="odstrani'. $row['id'] .'" href="#"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
	  </tr>';
}

?>