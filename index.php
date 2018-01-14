<?php 

	require_once("config.php");
	//carrega 1 usuário
	//$user = new Usuario();
	//$user->loadById(10);
	//echo $user;

	// carrega uma lista de usuários
	//$lista= Usuario::getList();
	//echo json_encode($lista);

	//Carrega um a lista de usuários buscando pelo login e senha

	$usuario = new Usuario();
	$usuario->login("San","9");
	echo ($usuario);

	//Carrega um a lista de usuários buscando pelo login
	//$search = Usuario::search("San");
	//echo json_encode($search);




	//Carrega um a lista de usuários buscando pelo login e a senha
	//$sql = new Sql();
	//$clientes = $sql->select("SELECT * FROM tb_clientes");
	//echo json_encode($clientes);

?>