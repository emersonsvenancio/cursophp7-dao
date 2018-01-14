<?php 

	class Usuario {
		
		private $idcliente; 
		private $desnomecliente;
		private $desresponsavel;

		public function getIdcliente(){
			return $this->idcliente;			
		}
		public function setIdcliente($value) {
			$this->idcliente = $value;
		}
		
		public function getDesnomecliente(){
			return $this->desnomecliente;			
		}
		public function setDesnomecliente($value) {
			$this->desnomecliente = $value;
		}
		
		public function getDesresponsavel(){
			return $this->desresponsavel;			
		}

		public function setDesresponsavel($value) {
			$this->desresponsavel = $value;
		}
		
		public function loadById($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_clientes where id_Cliente = :ID", array(
				":ID"=>$id
			));

			if (count($results) > 0) {

				$row = $results[0];

				$this->setIdcliente($row['id_Cliente']);
				$this->setDesnomecliente($row['Nome_Cliente']);
				$this->setDesresponsavel($row['Responsavel']);

			}
		}


		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_clientes ORDER BY id_Cliente");

		}


		public static function search($login){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_clientes WHERE Nome_Cliente LIKE :SEARCH ORDER BY id_Cliente", array(
				':SEARCH'=>"%". $login. "%"
			));

		}

		public function login($login,$password) {

				$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_clientes where Nome_Cliente LIKE :LOGIN AND id_Cliente = :PASSWORD", array(
				':LOGIN'=>"%". $login. "%",
				':PASSWORD'=>$password

			));

			if (count($results) > 0) {

				$row = $results[0];

				$this->setIdcliente($row['id_Cliente']);
				$this->setDesnomecliente($row['Nome_Cliente']);
				$this->setDesresponsavel($row['Responsavel']);

			} else {

				throw new Exception("Usuário ou senha inválido");			
			}
		}

		public function __toString(){

			return json_encode(array(
				"id_Cliente"=>$this->getIdcliente(),
				"Nome_Cliente"=>$this->getDesnomecliente(),
				"Responsavel"=>$this->getDesresponsavel()

			));

		}

	}  

 ?>