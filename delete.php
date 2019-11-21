<?php 

include 'db.php';
$id = (int)$_GET['id'];
$sql = "delete from tasks where id = '$id'"; //query to delete the id which you want to delete
$val = $db->query($sql);

if ($val) {
	header('location: index.php');
}






 ?>