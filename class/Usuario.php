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

				$this->setData($results[0]);
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

				$this->setData($results[0]);

			} else {

				throw new Exception("Usuário ou senha inválido");			
			}
		}

		public function setData($data){

				$this->setIdcliente($data['id_Cliente']);
				$this->setDesnomecliente($data['Nome_Cliente']);
				$this->setDesresponsavel($data['Responsavel']);

		}
		public function insert() {

			$sql = new Sql();
			$results = $sql->select("CALL sp_usuarios_insert(:NOME, :RESPONSAVEL)", array(
				':NOME'=>$this->getDesnomecliente(),
				':RESPONSAVEL'=>$this->getDesresponsavel()
			));

			if (count($results) > 0) {
				$this->setData($results[0]);
			}

		}

	
		public function update($nome, $responsavel) {

			$this->setDesnomecliente($nome);
			$this->setDesresponsavel($responsavel);

			$sql = new Sql();

			$sql->query("UPDATE tb_clientes SET Nome_Cliente = :NOME, Responsavel = :RESPONSAVEL WHERE id_Cliente = :ID", array(

				':NOME'=>$this->getDesnomecliente(),
				':RESPONSAVEL'=>$this->getDesresponsavel(),
				':ID'=>$this->getIdcliente()
			));

		}

		public function delete(){

			$sql = new Sql();

			$sql->query("DELETE FROM tb_clientes WHERE id_Cliente = :ID", array(

				':ID'=>$this->getIdcliente()

			));

			$this->setIdcliente(0);
			$this->setDesnomecliente("");
			$this->setDesresponsavel("");


		}

		public function __construct($nome= "", $responsavel = "") {

			$this->setDesnomecliente($nome);
			$this->setDesresponsavel($responsavel);

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