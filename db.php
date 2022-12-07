<?php 
try{
	$db = new PDO("mysql:host=localhost;dbname=seydisehir_db;","root","");
			//echo "Succesfuly";
}catch(PDOExpection $e){
			//echo "Fail: " . $e;
}


