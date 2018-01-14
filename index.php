<?php 

	require_once("config.php");

	$user = new Usuario();

	$user->loadById(10);

	echo $user;

	//$sql = new Sql();

	//$clientes = $sql->select("SELECT * FROM tb_clientes");
	
	//echo json_encode($clientes);

?>