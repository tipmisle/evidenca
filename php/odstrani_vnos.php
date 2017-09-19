<?php 
//Povezava z bazo in config.php
include '../cfg/config.php';
include '../include/pdo_connection.php';

$id = $_POST['id'];

echo $id;
//SQL stavek, ki odstrani vnos iz baze
$query = "DELETE FROM evidenca.vnosi WHERE id = $id";

$result = $conn->query($query);

//končamo izvajanje skripte
exit;

?>

