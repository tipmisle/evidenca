<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

//Določimo elemente, ki jih prejmemo z index.php
$znesek = $_POST['znesek'];
$vrsta_stroska = $_POST['vrsta_stroska'];
$date = date('d-m-Y', strtotime($_POST['datum']));
$opis = $_POST['opis'];

//mini varovalka
if ($znesek == "") {
	$znesek = 0;
}


if ($date == "01-01-1970") {
	try {
		//SQL stavek, ki vnese podatke v bazo
	    $sql = $conn->prepare("INSERT INTO vnosi (vrsta, datum, znesek, opis)
	    		VALUES (:vrsta, current_timestamp(), :znesek, :opis)");
	    $sql->bindParam(':vrsta', $vrsta_stroska);
	    $sql->bindParam(':znesek', $znesek);
	    $sql->bindParam(':opis', $opis);
	    $sql->execute();
	    //sporočilo, ki ga prikažemo v div-u data
    	echo "Vnos stroška je bil uspešen!";
    }
	catch(PDOException $e) {
    	echo $sql . "<br>" . $e->getMessage();
    }
} else {
	try {
		//SQL stavek, ki vnese podatke v bazo
	    $sql = $conn->prepare("INSERT INTO vnosi (vrsta, datum, znesek, opis)
	    		VALUES (:vrsta, str_to_date(:date,'%d-%m-%Y'), :znesek, :opis)");
	    $sql->bindParam(':vrsta', $vrsta_stroska);
	    $sql->bindParam(':znesek', $znesek);
	    $sql->bindParam(':opis', $opis);
	    $sql->bindParam(':date', $date);
	    $sql->execute();
	    //sporočilo, ki ga prikažemo v div-u data
    	echo "Vnos stroška je bil uspešen!";
    }
	catch(PDOException $e) {
    	echo $sql . "<br>" . $e->getMessage();
    }
}





?>