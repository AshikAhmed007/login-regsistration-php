<?php 
session_start();
try{
	$db=new PDO("mysql:host=localhost;dbname=signup_confirm","root","");
	$db->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Connected";
	return $db;
}
catch(PDOEXCEPTION $e){
	echo "ERROR: ".$e->getMessage();

}



 ?>