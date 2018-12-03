<?php
	
	session_start();

	include_once('maLibSQL.pdo.php');

	$sql="SELECT nbPassagersTransportes(". $_SESSION['id'] .");";

	$data = SQLGetChamp($sql);

	echo ($data);
?>