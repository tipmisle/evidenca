<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

$query = "SELECT * FROM vnosi";
$result = $conn->query($query);
echo '<tr>
			<td class="text-center"><a href="#"><span class="glyphicon glyphicon-sort"></span></a></td>
			<td class="text-center"><a href="#"><span class="glyphicon glyphicon-sort"></span></a></td>
			<td class="text-center"><a href="#"><span class="glyphicon glyphicon-sort"></span></a></td>
	  </tr>';
while($row = $result->fetch(PDO::FETCH_ASSOC)){
echo '<tr>
		<td class="text-center">'. $row['vrsta'] .'</td>
		<td class="text-center">'. $row['datum'] .'</td>
		<td class="text-center">'. $row['znesek'] .'€</td>
	  </tr>';
}

?>