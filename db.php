<?php 

$db = new Mysqli;
$db->connect('localhost','root','','crud'); //connectivity to databases
if (!$db) {
	echo "success";	  // check connection 
}

 ?>
