<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

$znesek = $_POST['znesek'];
$vrsta_stroska = $_POST['vrsta_stroska'];
$date = date('d-m-Y', strtotime($_POST['datum']));

if ($date == "01-01-1970") {
	try {
	    $sql = "INSERT INTO vnosi (vrsta, datum, znesek)
	    		VALUES ('$vrsta_stroska', current_timestamp(), $znesek)";
	    // use exec() because no results are returned
	    $conn->exec($sql);
    	echo "Vnos stroška je bil uspešen!";
    }
	catch(PDOException $e) {
    	echo $sql . "<br>" . $e->getMessage();
    }
} else {
	try {
	    $sql = "INSERT INTO vnosi (vrsta, datum, znesek)
	    		VALUES ('$vrsta_stroska', str_to_date('$date','%d-%m-%Y'), $znesek)";
	    // use exec() because no results are returned
	    $conn->exec($sql);
    	echo "Vnos stroška je bil uspešen!";
    }
	catch(PDOException $e) {
    	echo $sql . "<br>" . $e->getMessage();
    }
}





?>